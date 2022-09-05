<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'uuid' => $this->uuid,
            'name' => $this->first_name .' ' . $this->last_name,
            'balance' =>  number_format($this->balance, 2, '.', ''),
            'balanceLastUpdated' => date('Y-m-d h:i:s', strtotime($this->updated_at)),
        ];
    }
}
