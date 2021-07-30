<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
       
        $rules =  [                     
            'name' => 'required|unique:questions,name' ,     
            'dimension_id' => 'required|exists:questions,id',
            'status'    => 'required|in:A,I',        
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route()->parameter('question');
            $rules['name'] = 'required|unique:questions,name,' . $id ;            
        }
        return $rules;

    }
}
