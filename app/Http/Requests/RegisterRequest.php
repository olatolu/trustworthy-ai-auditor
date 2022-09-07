<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'name'               => ['required', 'string', 'max:255'],
            'email'              => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'              => ['required', 'numeric'],
            'country'            => ['required'],
            'state'              => ['required_without:other_state'],
            'other_state'        => ['required_without:state'],
            'company_name'       => ['required'],
            'designation'        => ['required'],
            'industry'           =>['required'],
            'password'           => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
