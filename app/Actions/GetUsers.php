<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class GetUsers
{
    public function __invoke(): JsonResponse
    {
        $users = User::query()
                     ->whereNotIn('id', [auth()->id()])
                     ->get();
        return response()->json($users);
    }
}
