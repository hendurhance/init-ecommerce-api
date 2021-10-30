<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->product->name,
            'title' => $this->product->title,
            'description' => $this->product->description,
            'price' => $this->product->price,
            'discount' => $this->product->discount,
            'actual_price' => round($this->product->price - ($this->product->price * $this->product->discount / 100), 2),
            'image' => $this->product->image,
            'category' => $this->category->name,
            'href' => [
                'category' => route('categories.show', $this->category->id),
                'product' => route('products.show', $this->product->id),
            ],
        ];
    }
}
