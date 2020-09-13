<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Stock extends JsonResource
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
            'quantity' => $this->quantity,
            'product_name' => $this->product->name,
            'purchased_price' => $this->purchased_price,
            'unit_price' => $this->unit_price,
            'stock_value' => $this->quantity * $this->unit_price
        ];
    }
}
