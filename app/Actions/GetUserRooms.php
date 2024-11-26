<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;

class GetUserRooms
{
    public function __invoke(int $userId)
    {
        return User::query()
                   ->findOrFail($userId)
                   ->rooms()
                   ->with('users')
                   ->get();
    }
}
