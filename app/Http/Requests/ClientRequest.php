<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'phone' => 'required',
                    'email' => 'required',
                    'address' > 'nullable'
                ];
            }
            case 'PATCH':
            case 'PUT': {
                $client = $this->route('clients');

                $id = $client->id;
                return [
                    'name' => 'required',
                    'phone' => 'unique:clients,phone,' . $id,
                    'email' => 'unique:clients,email,' . $id,
                    'address' > 'nullable'
                ];
            }
        }
    }
}
