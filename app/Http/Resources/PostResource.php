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
//        return parent::toArray($request);
        return [
            "id" => $this->id ,
            "cover" => $this->cover ,
            "title_fa" => $this->title_fa ,
            "title_en" => $this->title_en ,
            "slug" => $this->slug ,
            "caption_fa" => $this->caption_fa ,
            "caption_en" => $this->caption_en ,
            "body_fa" => $this->body_fa ,
            "body_en" => $this->body_en ,
            "time" => $this->created_at ,
            "Disable" => $this->disable ,
            "tags" => $this->whenLoaded('tags' , function (){
                return TagResource::collection($this->tags);
            })
        ];
    }
}
