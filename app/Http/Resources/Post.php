<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Post extends JsonResource
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
           'id' => $this->id,
            'user_id'=> $this->user_id,
            'title'=> $this->title,
            'content'=> $this->content,
            'photo'=> $this->photo,
            'slug'=>$this->slug,
            'deleted_at'=> $this->deleted_at,
            'created_at'=> $this->created_at->format('d/m/y'),
            'updated_at'=> $this->updated_at->format('d/m/y'),

        ];

    }
}
