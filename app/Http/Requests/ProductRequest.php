<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    'name' => 'required',
                    'company_id' => 'required',
                    'manufacturer' => 'nullable',
                    'quantity' > 'nullable',
                    'category' => 'nullable',
                    'weight' => 'nullable'
                ];
            }
            case 'PATCH':
            case 'PUT': {
                $product = $this->route('product');

                $id = $product->id;
                return [
                    'name' => 'unique:products,name,' . $id,
                    'manufacturer' => 'nullable',
                    'category' => 'nullable',
                    'quantity' > 'nullable',
                    'weight' => 'nullable'
                ];
            }
        }
    }
}
