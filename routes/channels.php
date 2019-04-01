<?php

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

Broadcast::channel('chats.{id}', function ($user, $id) {
    return (int) $id === (int) $id;
});
Broadcast::channel('chat', function ($user) {
        return ['email' => $user->email, 'name' => ucfirst($user->name), 'id'=> $user->id];
});