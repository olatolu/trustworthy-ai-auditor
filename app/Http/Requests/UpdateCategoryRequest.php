<?php

namespace App\Http\Requests;

use App\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'sections'              => 'numeric|min:0',
            'start_at'              => 'date',
            'end_at'                => 'date|after:start_date',
            'test_duration'         => 'numeric|min:0',
            'sections_labels.*'     => 'required_unless:sections,0',
            'sections_headings.*'   => 'required_unless:sections,0',
            'style'                 => 'required',
            'bar_chart_section'     => 'required_unless:bar_chart,0|lte:sections',
        ];
    }
}
