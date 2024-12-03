<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\GotMessage;
use App\Jobs\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class HandleNewChat
{
    public function __invoke(Request $request)
    {
        // Create chat
        $chat = (new CreateChat())($request);


        // Add users to chat
        $senderId   = auth()->id();
        $receiverId = $request->user['id'];
        $chat->users()->sync([$senderId, $receiverId]);

        // Chatga va userga messageni bog'lash
        $message = Message::query()->create([
            'user_id' => $senderId,
            'room_id' => $chat->id,
            'text'    => $request->text
        ]);

        // Yangi message haqida xabar berish
        SendMessage::dispatch($message);

        return $chat;
    }
}
