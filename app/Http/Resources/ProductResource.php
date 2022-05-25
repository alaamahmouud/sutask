<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "id"            => (int)$this->id,
            "title"         => (string) $this->title,
            "des"           => (string) $this->des,
            "price"         => (string) $this->price,
            'ratings'       => RatingResource::collection($this->ratings),
            'avgRating'     => $this->averageRating()
        ];

    }
}
