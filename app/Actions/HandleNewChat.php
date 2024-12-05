<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\GotNewChat;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class HandleNewChat
{
    public function __invoke(Request $request): ?Room
    {
        $senderId   = auth()->id();
        $receiverId = $request->user['id'];

        $sendersRoom   = Room::query()->whereHas('users', function ($query) use ($senderId) {
            $query->where('user_id', $senderId);
        });
        $receiversRoom = Room::query()->whereHas('users', function ($query) use ($receiverId) {
            $query->where('user_id', $receiverId);
        });

        $sendersRoomsId   = $sendersRoom->pluck('id')->toArray();
        $receiversRoomsId = $receiversRoom->pluck('id')->toArray();
        $roomId           = last(array_intersect($sendersRoomsId, $receiversRoomsId));

        if (!$roomId) {
            $chat = (new CreateChat())($request);
        } else {
            $chat = Room::query()->find($roomId);
        }

        // Add users to chat
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
