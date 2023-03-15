<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'imagePath' => $this->imagePath,
            'body' => $this->body,
            'user' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
            'category_id' => $this->category_id,
        ];
    }
}
