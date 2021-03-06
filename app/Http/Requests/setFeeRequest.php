<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class setFeeRequest extends FormRequest
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
        return [
            'amount'=>'numeric|min:100|required'//
        ];
    }
    function messages()
    {
        return [
            'amount'=>'Amount must be provided and must be greater than 0', 
           
        ];
    }
}
