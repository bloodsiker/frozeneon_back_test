<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoosterpackResource extends JsonResource
{
    public static $wrap = 'boosterpacks';

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
            'price' => $this->price,
            'bank' => $this->bank,
            'us' => $this->us,
            'time_created' => (string) $this->time_created,
        ];
    }
}
