<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\GotNewChat;
use App\Jobs\SendMessage;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class HandleNewChat
{
    public function __invoke(Request $request): ?Room
    {
        // Create chat
        $chat = (new CreateChat())($request);

        // Add users to chat
        $senderId   = auth()->id();
        $receiverId = $request->user['id'];
        $chat->users()->sync([$senderId, $receiverId]);

        // Chatga va userga messageni bog'lash
        Message::query()->create([
            'user_id' => $senderId,
            'room_id' => $chat->id,
            'text'    => $request->text
        ]);

        $chat = $chat->with('users')->latest()->first();

        // Yangi message haqida xabar berish
        broadcast(new GotNewChat($chat));

        return $chat;
    }
}
