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
        $arrays = [1, 6, 8, 9, 12];

        for($i = 1; $i <= $fields_num; $i++){
            if(in_array($i, $arrays)){
                $rules['q' . $i] = 'required|array';
                $rules['q' . $i . '_other'] = 'required_if:q' . $i . '_get_others,Others';
            }else {
                $rules['q' . $i] = 'required';
                $rules['q' . $i . '_other'] = 'required_if:q' . $i . ',Others';
            }
        }
        $rules['assessment'] = 'required';
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
