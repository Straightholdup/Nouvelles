<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;


class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($category) {
            return (new CategoryResource($category))->additional([
                'children' => new CategoryCollection($category->children)
            ]);
        });
    }
}
