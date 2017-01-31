<?php

namespace App\Services\Chat;

use Illuminate\Support\Collection;
use Telegram;
use Telegram\Bot\Exceptions\TelegramResponseException;
use App\User;
use Illuminate\Support\Facades\Log;

class TelegramService implements ChatService
{
    private function getSubscriberLogin($activityMessage)
    {
        $params = explode(' ', $activityMessage);
        return $params[1];
    }

    private function isSubscribeActivity($activityMessage)
    {
        $params = explode(' ', $activityMessage);
        return $params[0] === '/subscribe';
    }

    private function getMessage($activity)
    {
        return $activity['message']['text'];
    }

    private function getChatId($activity)
    {
        return $activity['message']['chat']['id'];
    }

    private function getSubscribers()
    {
        $subscribers = new Collection();
        $lastActivities = new Collection(Telegram::getUpdates());

        $lastActivities->each(function ($activity) use ($subscribers) {
            $message = $this->getMessage($activity);

            if ($this->isSubscribeActivity($message)) {
                $chatId = $this->getChatId($message);
                $subscriberLogin = $this->getSubscriberLogin($message);

                $subscriber = [
                    'chat_id' => $chatId,
                    'login' => $subscriberLogin
                ];

                $subscribers->push($subscriber);
            }
        });

        return $subscribers;
    }

    public function sendMessage($params)
    {
        try {
            Telegram::sendMessage($params);
        } catch (TelegramResponseException $e) {
            Log::critical('Can not send message for ' . $params['chat_id'] . '. Error message: ' . $e->getMessage());
            return false;
        }

        return true;
    }

    public function updateSubscribers()
    {
        $subscribers = $this->getSubscribers();

        $subscribers->each(function ($subscriber) {
            $user = User::where('number', $subscriber['number'])->first();
            $user->chat_id = $subscriber['chat_id'];
            $user->save();

            $this->sendMessage([
                'chat_id' => $user->chat_id,
                'text' => 'Вы успешно подписались'
            ]);
        });
    }
}
