<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $detectHttpVerb = $this->method();
        switch ($detectHttpVerb) {
            case 'POST': {
                return [
                    'company_id' => 'required',
                    'product_id' => 'required',
                    'client_id' => 'nullable',
                    'quantity_sold' => 'required',
                    'unit_price' > 'required',
                    'discount' => 'nullable',
                    'tax_rate' => 'required',
                    'total_amount' => 'required',
                ];
            }
            case 'PATCH':
            case 'PUT': {
                $sale = $this->route('sales');

                $id = $sale->id;
                return [
                    'company_id' => 'required',
                    'product_id' => 'required',
                    'client_id' => 'nullable',
                    'quantity_sold' => 'required',
                    'unit_price' > 'required',
                    'discount' => 'nullable',
                    'tax_rate' => 'required',
                    'total_amount' => 'required',
                ];
            }
        }
    }
}
