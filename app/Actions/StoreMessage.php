<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\SendMessage;
use App\Models\Message;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class StoreMessage
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $message = Message::query()->create([
            'user_id' => auth()->id(),
            'text'    => request()->get('text'),
            'room_id' => request()->get('chatId'),
        ]);

        SendMessage::dispatch($message);

        return response()->json([
            'success' => true,
            'message' => "Message created and job dispatched.",
        ]);
    }
}
