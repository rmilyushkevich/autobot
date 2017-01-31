<?php

namespace App\Services\Chat;

interface ChatService
{
    public function sendMessage($params);

    public function updateSubscribers();
}
