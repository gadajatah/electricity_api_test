<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionSingleResource extends JsonResource
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
            'transactionId' => $this->uuid,
            'status' => $this->status,
            'monthPaid' => "Aug",
            'amountPaid' => "2000.00",
            'paidAt' => "YYYY-MM-DD hh:mm:ss",
        ];
    }
}
