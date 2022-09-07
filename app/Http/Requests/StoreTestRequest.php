<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
            return [
                'questions' => [
                    'required_if:f_submit,0', 'array'
                ],

                'category_id' => [
                    'required',
                    'integer',
                ],

                'questions.*' => [
                    'required_if:f_submit,0'
                ],
            ];
    }
}
