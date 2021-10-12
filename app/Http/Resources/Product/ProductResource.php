<?php

namespace App\Http\Resources\Product;

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
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'actual_price' => round($this->price - ($this->price * $this->discount / 100), 2),
            'stock' => $this->stock == 0 ? 'Product is out of Stock' : $this->stock,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->avg('rating'), 2) : 'No rating yet',
            'image' => $this->image,
            'href' => [
                'link' => route('products.show', $this->id),
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
