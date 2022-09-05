<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'month' => $this->month,
            'status' => $this->status,
            'amount' => number_format($this->amount, 2, '.', ''),
            'user_uuid' => $this->user_uuid,
            'created' => date('Y-m-d h:i:s', strtotime($this->created_at)),
            'updated' => date('Y-m-d h:i:s', strtotime($this->updated_at))
        ];
    }
}
