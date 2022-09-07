@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <td>
                            <a href="{{route('client.get.test.start', $category->slug)}}" target="_blank">{{ $category->name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.sections') }}
                        </th>
                        <td>
                            {{ $category->sections }}
                        </td>
                    </tr>

                    @if(count($category->categoryReports)>0)

                        <tr>
                            <th>
                                {{ trans('cruds.category.fields.category_report') }}
                            </th>
                            <td>
                                <a href="{{route('admin.category.reports', $category->id)}}">{{ count($category->categoryReports) ?? '' }}</a>
                            </td>
                        </tr>

                    @endif

                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.questions') }}
                        </th>
                        <td>
                            <a href="{{route('admin.category.questions', $category->id)}}">{{ count($category->categoryQuestions) ?? '' }}</a>
                        </td>
                    </tr>

                    @if($category->sections_labels && count(get_object_vars($category->sections_labels))>0)
                        @foreach($category->sections_labels as $key=> $sections_label)
                            <tr>
                                <th>
                                    Label {{$key}} Name
                                </th>
                                <td>
                                    {{ $sections_label }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
