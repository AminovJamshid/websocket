<?php

use App\Actions\GetUserRooms;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/{userId}/rooms', function ($userId) {
    return (new GetUserRooms())($userId);
});

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}/messages', [RoomController::class, 'getMessages']);