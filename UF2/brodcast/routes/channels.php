<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{u1}.{u2}', function ($user, $u1, $u2) {
    if($user->id == $u1 || $user->id == $u2){
        return true;
    } else {
        return false;
    }
});

Broadcast::channel('_public_channel_', function () {
    return Auth::check();
});

Broadcast::channel('user.{to}', function ($to) {
    return Auth::check();
});

Broadcast::channel('_reactions_', function () {
    return Auth::check();
});

Broadcast::channel("_presence_channel_", function ($user) {
        return ['id' => $user->id, 'name' => $user->name];
});