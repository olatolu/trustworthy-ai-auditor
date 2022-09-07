<?php

namespace App\Http\Requests;

use App\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        $q = Category::findOrFail(request('category_id'));
        return [
            'category_id'   => 'required|integer',
            'question_text' => 'required',
            'order'         => 'numeric|min:0',
            'question_label'=> ($q->sections > 0) ? '' : 'required',
            'section'       => ($q->sections > 0) ? 'required|numeric|min:1|max:'.$q->sections : '',
        ];
    }
}
