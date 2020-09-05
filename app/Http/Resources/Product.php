<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'name' => $this->name,
            'quantity' => $this->quantity,
            'company_id' => $this->company_id,
            'company_name' => $this->company->name,
            'manufacturer' => $this->manufacturer,
            'category' => $this->category,
            'weight' => $this->weight
        ];
    }
}
