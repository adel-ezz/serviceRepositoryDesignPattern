<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $request = [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'price'=>(float)$this->price
        ];
    }
}
