<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr= [
            'id'=>$this->id,
            'username'=>$this->username,
            'email'=>$this->title,
            'type'=>$this->message,
            'address'=>$this->address,
//            'created_at'=>$this->created_at->format('d-m-Y'),
//            'published_at'=>$this->created_at->diffForHumans(),

            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'published_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
        if (isset($this->token)) {
            $arr['token'] = $this->token;
        }
        return $arr;
    }
}
