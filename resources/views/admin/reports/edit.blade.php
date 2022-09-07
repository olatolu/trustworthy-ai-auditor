@extends('layouts.admin')
@section('content')

    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.update", [$report->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>

                {!! Form::select('category_id', $categories, old('category_id', $report->category->id), ['class' => $errors->has('category') ? 'form-control select2 js-example-placeholder-single is-invalid' : 'form-control select2 js-example-placeholder-single', 'id'=>'category_id', 'required'=>'required', 'disabled'=>'disabled', 'multiple' => false]) !!}

            @if($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
            </div>

            @if($report->is_for == 'section' && $report->category->sections > 0)

                <div class="form-group">
                    <label class="" for="section_id">{{ trans('cruds.report.fields.section_id') }}</label>
                    <select class="form-control {{ $errors->has('section_id') ? 'is-invalid' : '' }}" name="section_id" id="section_id">
                        <option value="" selected="selected" disabled>Select Option</option>
                    @for($i = 1; $i <= $report->category->sections; $i++)
                            @if($i == old('section_id', $report->section_id))
                                <option value="{{$i}}" selected="selected">{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                    @if($errors->has('section_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('section_id') }}
                        </div>
                    @endif
                </div>

              @for($i = 1; $i<=5; $i++)

                <div class="form-group mt-5">
                    <label class="required" for="name">{{ trans('cruds.report.fields.sections_descriptions') }} {{$i}}</label>
                        <textarea name="sections_descriptions[{{$i}}]" class="form-control my-editor">{!! old('sections_descriptions.'.$i, $report->sections_descriptions->$i ?? '') !!}</textarea>
                </div>

                @if($errors->has('sections_descriptions*'.$i.''))
                    <div class="invalid-feedback" style="display: block;">
                        {{ $errors->first('sections_descriptions*'.$i.'') }}
                    </div>
                @endif

              @endfor
            @endif

            <div class="form-group mt-5">
                <label class="" for="name">{{ trans('cruds.report.fields.demo_description') }}</label>
                <textarea name="demo_description" class="form-control my-editor">{!! old('demo_description', $report->demo_description ?? '') !!}</textarea>
            </div>

            <div class="form-group">
                <label class="required d-block" for="is_for">{{ trans('cruds.report.fields.is_for') }}</label>
                <div class="checkbox d-inline mr-3">
                    <label for=""><input type="radio" disabled  class="" name="is_for" value="section" {{(old('is_for') == 'section' || $report->is_for === 'section') ? 'checked':''}}> Section</label>
                    <label for=""><input type="radio" disabled name="is_for" value="question" {{(old('is_for') == 'question' || $report->is_for == 'question') ? 'checked':''}}> Question</label>
                    @if($errors->has('is_for'))
                        <div class="invalid-feedback" style="display: block;">
                            {{ $errors->first('is_for') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

    <script>

        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | link image media",
            relative_urls: false,
            textcolor_cols: "5",
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>



@endsection
