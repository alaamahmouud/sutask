<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => (int)$this->id,
            "user_type" => (string)$this->type,
            "first_name" => (string) $this->first_name,
            "last_name" => (string) $this->last_name,
            // "phone" => (string) $this->phone,
            "email" => (string) $this->email,
        ];
    }
}
