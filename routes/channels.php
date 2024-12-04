<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('channel_for_everyone', function ($user) {
//    return true;
//});

Broadcast::channel("room.{id}", function ($user, $id) {
    return (bool) $user->rooms()
                       ->where('id', $id)
                       ?->first()
        ->id;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
