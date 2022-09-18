<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRegisterRequest extends FormRequest
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
            'profile_id'=>'required',
            'type'=>'required',
            'toolkit_id'=>'required_if:type,existing',
            'manufacturer_name'=>'required_if:type,new',
            'country'=>'required_if:type,new',
            'release_date'=>'required_if:type,new',
            'source_url'=>'nullable|required_if:type,new|url',
            'description'=>'required_if:type,new|max:500',
            'attachment'=>['nullable','file','required_if:type,new','max:6048','mimes:pdf,png,jpg,jpeg'],
        ];
    }
}
