<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class JoinCourseRecourse extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumb' => $this->thumb,
            'charge' => $this->charge,
            'short_description' => markdown_to_html($this->short_description),
            'published_at' => strtotime($this->published_at),
            'pivot' => [
                'charge' => $this->pivot->charge,
                'created_at' => strtotime($this->pivot->created_at),
            ],
        ];
    }
}
