<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
        return self::field_rules();
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return self::field_messages();
    }

    /**
     * Get the rules pattern that apply to the request.
     *
     * @return array
     */
    private static function field_rules($fields_num = 11)
    {
        $rules = [];

        for($i = 1; $i <= $fields_num; $i++){
            $rules['q'.$i] = 'required';
            $rules['q'.$i.'_other'] = 'required_if:q'.$i.',Others';
        }
        return $rules;
    }

    /**
     * Get the messages pattern that apply to the request.
     *
     * @return array
     */
    private static function field_messages($fields_num = 12)
    {
        $messages = [];

        for($i = 1; $i <= $fields_num; $i++){
            $messages['q'.$i.'.required'] = 'The question '.$i.' field is required';
            $messages['q'.$i.'_other'.'.required_if'] = 'The question '.$i.' others field is required when question '.$i.' is Others.';
        }
        return $messages;
    }
}
