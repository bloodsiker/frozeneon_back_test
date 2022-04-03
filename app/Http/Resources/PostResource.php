<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'post';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'user' => $this->user,
            'img' => $this->img,
            'text' => $this->text,
            'likes' => $this->likes,
            'comments' => CommentResource::collection($this->getParentComments()),
            'time_created' => (string) $this->time_created,
        ];
    }
}
