<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AddonsInstallFailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actionType;
    public $message;

    /**
     * AddonsInstallFailEvent constructor.
     *
     * @param Addons        $addons
     * @param AddonsVersion $version
     * @param string        $actionType
     * @param string        $message
     */
    public function __construct(Addons $addons, AddonsVersion $version, string $actionType, string $message = '')
    {

        $this->actionType = $actionType;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
