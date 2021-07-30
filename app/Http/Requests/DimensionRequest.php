<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DimensionRequest extends FormRequest
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
        //$id = $this->route()->parameter('dimension');
        $rules =  [                     
            'name' => 'required|unique:dimensions,name' ,            
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route()->parameter('dimension');
            $rules['name'] = 'required|unique:dimensions,name,' . $id ;            
        }
        return $rules;
    }
}
