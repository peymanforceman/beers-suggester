<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uid,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'image' => $this->image_url,
            'abv' => $this->abv,
        ];
    }
}
