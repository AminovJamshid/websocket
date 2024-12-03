<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Room;
use Illuminate\Http\Request;

class CreateChat
{
    public function __invoke(Request $request): Room|null
    {
        return Room::query()->create(['type' => $request->get('type') ?? Room::PRIVATE]);
    }
}
