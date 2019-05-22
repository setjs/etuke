<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => new UserResource($this->user),
            'content' => markdown_to_html($this->content),
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
