<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            "id" => $this->id ,
            "label_fa" => $this->label_fa ,
            "label_en" => $this->label_en ,
            "slug" => $this->slug ,
            "caption_fa" => $this->caption_fa ,
            "caption_en" => $this->caption_en ,
            "cover" => $this->img ,
            "posts" => $this->whenLoaded('posts' , function (){
                return PostResource::collection($this->posts);
            })
        ];
    }
}
