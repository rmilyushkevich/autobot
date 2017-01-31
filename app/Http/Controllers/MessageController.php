<?php

namespace App\Http\Controllers;

use App\Services\Chat\ChatService;
use App\User;
use App\Filter;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Redis;
use App\Services\Search\ElasticQueryBuilder;

class MessageController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function show($id)
    {
        $messages = Message::where('user_id', $id)->get();
        return view('messages.list', compact('messages'));
    }

    public function test(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $result = $this->chatService->sendMessage([
            'chat_id' => $user->chat_id,
            'text' => 'Test message'
        ]);

        if (!$result) {
            return redirect()->back()->with('error', 'Can not send message');
        }

        $message = new Message();
        $message->user()->associate($user);
        $message->message = 'Test message';
        $message->save();

        return redirect()->back();
    }

    public function parse()
    {
        $cars = json_decode(Redis::get('cars'));

        $filters = [];
        foreach ($cars as $car) {
            $findFilters = Filter::searchByQuery(
                ElasticQueryBuilder::build()
                    ->match('mark.name', $car->mark)
                    ->rangeFrom('min_year', $car->year)
                    ->rangeTo('max_year', $car->year)
                    ->make()
            );

            foreach ($findFilters as $filter) {
                $filters[] = [
                    'user_id' => $filter->user_id,
                    'link' => $car->link,
                    'year' => $car->year
                ];
            }
        }

        return $filters;
    }
}
