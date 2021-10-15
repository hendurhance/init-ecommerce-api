<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource->parent_id == null) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image,
                'is_parent' => is_null($this->parent_id)
            ];
        }else{
            return [
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $this->image,
                'is_parent' => is_null($this->parent_id),
                'parent_id' => $this->parent_id ? $this->parent_id : true
            ];
        }
    }
}
