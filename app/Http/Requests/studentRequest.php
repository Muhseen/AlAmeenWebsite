<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentRequest extends FormRequest
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
            'regno' => 'required|students:unique',
            'FirstName' => 'required',
            'MiddleName' => '',
            'LastName' => 'required',
            'gender' => 'required',
            'Faculty' => 'required',
            'level' => 'required',
            'course' => 'required',
            'dateofbirth',
            'parentname',
            'parentoccupation',
            'parentcontact',
            'StreetAddress',
            'bloodgroup',
            'PChallenge',
            'alias',
            'indexNo',
            'genotype',
            'DOC',
            'state',
            'ward',
            //
        ];
    }
    public function messages()
    {
        return [
            'regno.required' => "PLease provide a registration number for the Students",
            'regno.unique' => "A student with this registration number already exists",
            'FirstName.required' => "Please Provide a Firts Name",
            'LastName.required' => "Please provide a Last Name",
            'gender.required' => "Gender must be Provided",
            'Faculty.required' => 'Faculty Must be Provided',
            'level.required' => 'Level must be provided',
            'course.required' => 'Course of Study must be provided',
        ];
    }
}