<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Room;

class GetChatMessages
{
    public function __invoke(int $chatId): \Illuminate\Http\JsonResponse
    {
        $messages = Room::query()->findOrFail($chatId)->messages;

        return response()->json($messages);
    }
}
