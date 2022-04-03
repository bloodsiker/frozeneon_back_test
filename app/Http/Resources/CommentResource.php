<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public static $wrap = false;

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
            'user' => [
                'id' => $this->user->id,
                'personaname' => $this->user->personaname,
                'avatarfull' => $this->user->avatarfull,
            ],
            'text' => $this->text,
            'likes' => $this->likes,
            'reply' => self::collection($this->reply),
            'time_created' => (string) $this->time_created,
        ];
    }
}
