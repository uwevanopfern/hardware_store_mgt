<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sales extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'company_id' =>$this->company_id,
            'company_name' =>$this->company->name,
            'client' => $this->client != null ? $this->client->name : "random",
            'quantity' => $this->quantity_sold,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount != '0' ? $this->discount : false,
            'tax_rate' => $this->tax_rate,
            'tax_amount' => $this->tax_amount,
            'sub_total' => $this->sub_total,
            'total_amount' => $this->total_amount,
            'receipt_signature' => $this->receipt_signature
        ];
    }
}



