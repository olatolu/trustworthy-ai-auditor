@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.report.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.id') }}
                        </th>
                        <td>
                            {{ $report->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.category_label') }}
                        </th>
                        <td>
                            {{ $report->category->name ?? '' }}
                        </td>
                    </tr>
                    @if($report->is_for == 'section')
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.section_label') }}
                            </th>
                            <td>
                                {{ $report->section_id ?? '' }}
                            </td>
                        </tr>

                            @if($report->sections_descriptions && count(get_object_vars($report->sections_descriptions))>0)

                                @foreach($report->sections_descriptions as $key=> $sections_description)
                                    <tr>
                                        <th>
                                            {{ trans('cruds.report.fields.sections_descriptions') }} {{$key}}
                                        </th>
                                        <td>
                                            {!! $sections_description ?? '' !!}
                                        </td>
                                    </tr>
                                    @endforeach
                            @endif

                    @endif
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
