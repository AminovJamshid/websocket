<?php

use App\Actions\GetUserRooms;
use App\Actions\GetUsers;
use App\Actions\StoreMessage;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('chats');
});
Route::get('/users', GetUsers::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::post('/message', [HomeController::class, 'message'])->name('message');


Route::get('/chats/{chatId}/messages', function (int $chatId) {
    return (new \App\Actions\GetChatMessages())($chatId);
});

Route::get('/users/{userId}/chats', function ($userId) {
    return (new GetUserRooms())($userId);
});

Route::post('/chats/{chatId}/messages', StoreMessage::class);
