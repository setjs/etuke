<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Listeners\Frontend;

use Illuminate\Auth\Events\Registered;
use App\Notifications\RegisterNotification;

class UserRegisterSuccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        $user->notify(new RegisterNotification($user));
    }
}
