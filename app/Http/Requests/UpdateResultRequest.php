<?php

namespace App\Http\Requests;

use App\Result;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateResultRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id'      => [
                'required',
                'integer',
            ],
            'category_id' => 'required|integer',
            'questions.*'  => [
                'required',
            ],
            'questions'    => [
                'array',
            ],
        ];
    }
}
