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

        $id = $this->segment(3);
 
        $rules =  [                     
            'name' => ['required',"unique:dimensions,name,{$id},id"] ,            
        ];
        if ($this->method() == 'PUT') {
            $id = $this->route()->parameter('dimension');
            $rules['name'] = 'required|unique:dimensions,name';            
        }
       // dd(request()->all(),$this->method(),$this->segment(3),$rules,$this->route());
        return $rules;
    }
}
