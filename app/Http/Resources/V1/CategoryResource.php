<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subcategories = [];
        if ($this->subcategories) {
            $subcategories = new CategoryCollection($this->subcategories);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subcategories' => $subcategories,
        ];
    }
}
