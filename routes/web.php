<?php

use App\Actions\GetUserRooms;
use App\Actions\GetUsers;
use App\Actions\HandleNewChat;
use App\Actions\StoreMessage;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('chats');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::post('/message', [HomeController::class, 'message'])->name('message');


Route::prefix('chats')->group(function () {
    Route::get('/{chatId}/messages', function (int $chatId) {
        return (new \App\Actions\GetChatMessages())($chatId);
    });

    Route::post('/{chatId}/messages', StoreMessage::class);
    Route::post('/', fn(Request $request) => (new HandleNewChat())($request));
});

Route::prefix('users')->group(function () {
    Route::get('/', GetUsers::class);
    Route::get('/{userId}/chats', fn($userId) => (new GetUserRooms())($userId));
});

