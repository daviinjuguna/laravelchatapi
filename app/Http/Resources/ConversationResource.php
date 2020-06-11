<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id']= $this->id;
        $data['created_at']=$this->created_at;
        $data['messages'] = MessageResource::collection($this->messages);
        return $data;
       // return parent::toArray($request);

    }
}
