<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                     => (int) $this->id,
            'email'                  => $this->email,
            'personaname'            => $this->personaname,
            'avatarfull'             => $this->avatarfull,
            'rights'                 => $this->rights,
            'likes_balance'          => $this->likes_balance,
            'wallet_balance'         => $this->wallet_balance,
            'wallet_total_refilled'  => $this->wallet_total_refilled,
            'wallet_total_withdrawn' => $this->wallet_total_withdrawn,
            'time_created'           => (string) $this->time_created,
            'time_updated'           => (string) $this->time_updated,
        ];
    }
}
