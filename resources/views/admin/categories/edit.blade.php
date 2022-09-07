@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/colors/switch.css')}}">
@endsection

<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.category.fields.short_description') }}</label>
                <textarea name="short_description" class="form-control my-editor">{!! old('short_description', $category->short_description) !!}</textarea>
            </div>

            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.category.fields.description') }}</label>
                <textarea name="description" class="form-control my-editor">{!! old('description', $category->description) !!}</textarea>

            </div>

            <div class="row mb-3">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="start_at">{{ trans('cruds.category.fields.start_at') }}</label>
                        {!! Form::datetime('start_at', old('start_at', $category->start_at), ['class'=> $errors->has('start_at') ? 'form-control datetime is-invalid' : 'form-control datetime', 'required'=>'required']) !!}
                        @if($errors->has('start_at'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_at') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        <label class="required" for="end_at">{{ trans('cruds.category.fields.end_at') }}</label>
                        {!! Form::datetime('end_at', old('end_at', $category->end_at), ['class'=>$errors->has('end_at') ? 'form-control datetime is-invalid' : 'form-control datetime']) !!}

                        @if($errors->has('end_at'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_at') }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label class="" for="test_duration">{{ trans('cruds.category.fields.test_duration') }}</label>
                        <input class="form-control {{ $errors->has('test_duration') ? 'is-invalid' : '' }}" type="number" name="test_duration" id="test_duration" value="{{ old('test_duration') ?? $category->test_duration }}" step="1">
                        @if($errors->has('test_duration'))
                            <div class="invalid-feedback">
                                {{ $errors->first('test_duration') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="sections">{{ trans('cruds.category.fields.sections') }}</label>

                        <select class="form-control {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections" id="sections" required>
                            @for($i = 0; $i <= 20; $i++)
                                @if(old('sections') == $i || $category->sections== $i)
                                    <option value="{{$i}}" selected="selected">{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                        @if($errors->has('sections'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sections') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row" id="label_container">
                @if(old('sections_labels'))

                    @foreach(old('sections_labels') as $key => $sections_label)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="name">Section {{$key}} Label</label>
                                <input class="form-control {{ $errors->has('sections_labels.*') ? 'is-invalid' : '' }}" type="text" name="sections_labels[{{$key}}]" id="sections_labels-{{$key}}" value="{{$sections_label}}" required>
                            </div>
                        </div>
                    @endforeach
                    @elseif($category->sections_labels && count(get_object_vars($category->sections_labels)) > 0 )
                        @foreach($category->sections_labels as $key => $sections_label)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="name">Section {{$key}} Label</label>
                                <input class="form-control {{ $errors->has('sections_labels.*') ? 'is-invalid' : '' }}" type="text" name="sections_labels[{{$key}}]" id="sections_labels-{{$key}}" value="{{$sections_label}}" required>
                            </div>
                        </div>
                        @endforeach
                 @endif

                 @if(old('sections_headings'))

                        @foreach(old('sections_headings') as $key => $sections_heading)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="sections_headings-{{$key}}">Section {{$key}} Heading</label>
                                    <input class="form-control {{ $errors->has('sections_headings.*') ? 'is-invalid' : '' }}" type="text" name="sections_headings[{{$key}}]" id="sections_headings-{{$key}}" value="{{$sections_heading}}">
                                </div>
                            </div>
                        @endforeach
                  @elseif($category->sections_headings && count(get_object_vars($category->sections_headings)) > 0 )
                        @foreach($category->sections_headings as $key => $sections_heading)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="name">Section {{$key}} Heading</label>
                                    <input class="form-control {{ $errors->has('sections_headings.*') ? 'is-invalid' : '' }}" type="text" name="sections_headings[{{$key}}]" id="sections_headings-{{$key}}" value="{{$sections_heading}}">
                                </div>
                            </div>
                        @endforeach
                @endif

            </div>

            <div class="form-group">
                <label class="required d-block" for="style">{{ trans('cruds.category.fields.style') }}</label>

                <label class="d-inline mr-3" for="style">{!! Form::radio('style', 'color-1', (old('style', $category->style) =='color-1'?true:null) ) !!} <span class="color-1"><i class="fas fa-cog"></i></span></label>
                <label class="d-inline mr-3" for="style">{!! Form::radio('style', 'color-2', (old('style', $category->style) =='color-2'?true:null)) !!} <span class="color-2"><i class="fas fa-cog"></i></span></label>
                <label class="d-inline mr-3" for="style">{!! Form::radio('style', 'color-3', (old('style', $category->style) =='color-3'?true:null)) !!} <span class="color-3"><i class="fas fa-cog"></i></span></label>
                <label class="d-inline mr-3" for="style">{!! Form::radio('style', 'color-4', (old('style', $category->style) =='color-4'?true:null)) !!} <span class="color-4"><i class="fas fa-cog"></i></span></label>
                <label class="d-inline mr-3" for="style">{!! Form::radio('style', 'color-5', (old('style', $category->style) =='color-5'?true:null)) !!} <span class="color-5"><i class="fas fa-cog"></i></span></label>
            </div>

            <div class="checkbox d-inline mr-3">
                {!! Form::hidden('is_active', 0) !!}
                {!! Form::checkbox('is_active', 1, old('published', $category->is_active), []) !!}
                {!! Form::label('is_active',  trans('cruds.category.fields.is_active'), ['class' => 'checkbox control-label font-weight-bold']) !!}
            </div>

            <div class="checkbox d-inline mr-3">
                {!! Form::hidden('radar_chart', 0) !!}
                {!! Form::checkbox('radar_chart', 1, old('radar_chart', $category->radar_chart), ['id'=>'radar_chart_v']) !!}
                {!! Form::label('radar_chart',  trans('cruds.category.fields.radar_chart'), ['class' => 'checkbox control-label font-weight-bold']) !!}
            </div>

            <div class="checkbox d-inline mr-3">
                {!! Form::hidden('column_report', 0) !!}
                {!! Form::checkbox('column_report', 1, old('column_report', $category->column_report), ['id'=>'column_report']) !!}
                {!! Form::label('column_report',  'Column Report', ['class' => 'checkbox control-label font-weight-bold']) !!}
            </div>

            <div class="checkbox d-inline mr-3">
                {!! Form::hidden('c_room', 0) !!}
                {!! Form::checkbox('c_room', 1, old('c_room', $category->c_room), ['id'=>'c_room']) !!}
                {!! Form::label('c_room',  'Class Room', ['class' => 'checkbox control-label font-weight-bold']) !!}
            </div>

            <div class="checkbox d-inline mr-3">
                <span id="bar_chart" class="{{($category->bar_chart == 1 || $category->sections > 0 || old('sections') > 0 )? '':'d-none'}}">
                    {!! Form::hidden('bar_chart', 0) !!}
                    {!! Form::checkbox('bar_chart', 1, old('bar_chart', $category->bar_chart), ['id'=>'bar_chart_v']) !!}
                    {!! Form::label('bar_chart',  trans('cruds.category.fields.bar_chart'), ['class' => 'checkbox control-label font-weight-bold']) !!}
                </span>
            </div>

            <div class="checkbox d-inline mr-3">
                <span >
                    {!! Form::hidden('is_demo', 0) !!}
                    {!! Form::checkbox('is_demo', 1, old('is_demo', $category->is_demo)) !!}
                    {!! Form::label('is_demo',  trans('cruds.category.fields.is_demo'), ['class' => 'checkbox control-label font-weight-bold']) !!}
                </span>
            </div>

            <div class="row {{($category->bar_chart ==1 || old('bar_chart') == 1 )? '':'d-none'}} mt-3" id="bar_chart_section">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="bar_chart_section">{{ trans('cruds.category.fields.bar_chart_section') }}</label>
                        <input class="form-control {{ $errors->has('bar_chart_section') ? 'is-invalid' : '' }}" type="number" name="bar_chart_section" id="" value="{{ old('bar_chart_section') ?? $category->bar_chart_section }}" step="1">
                        @if($errors->has('bar_chart_section'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bar_chart_section') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="bar_chart_label">{{ trans('cruds.category.fields.bar_chart_label') }}</label>
                        <input class="form-control {{ $errors->has('bar_chart_label') ? 'is-invalid' : '' }}" type="text" name="bar_chart_label" id="" value="{{ old('bar_chart_label') ?? $category->bar_chart_label }}" step="1">
                        @if($errors->has('bar_chart_label'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bar_chart_label') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="">{{ trans('cruds.category.fields.bar_report_header') }}</label>
                        <textarea name="bar_report_header" class="form-control my-editor">{!! old('bar_report_header', $category->bar_report_header) !!}</textarea>
                        @if($errors->has('bar_report_header'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bar_report_header') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="">{{ trans('cruds.category.fields.bar_report_footer') }}</label>
                        <textarea name="bar_report_footer" class="form-control my-editor">{!! old('bar_report_footer', $category->bar_report_footer) !!}</textarea>
                        @if($errors->has('bar_report_footer'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bar_report_footer') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row {{($category->radar_chart ==1 || old('radar_chart') == 1 )? '':'d-none'}} mt-3" id="radar_chart_section">


                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" style="color: purple; font-weight: bold;" for="">{{ trans('cruds.category.fields.radar_report_header') }}</label>
                        <textarea name="radar_report_header" class="form-control my-editor">{!! old('radar_report_header', $category->radar_report_header) !!}</textarea>
                        @if($errors->has('radar_report_header'))
                            <div class="invalid-feedback">
                                {{ $errors->first('radar_report_header') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" style="color: purple; font-weight: bold;" for="">{{ trans('cruds.category.fields.radar_report_footer') }}</label>
                        <textarea name="radar_report_footer" class="form-control my-editor">{!! old('radar_report_footer', $category->radar_report_footer) !!}</textarea>
                        @if($errors->has('radar_report_footer'))
                            <div class="invalid-feedback">
                                {{ $errors->first('radar_report_footer') }}
                            </div>
                        @endif
                    </div>
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

    <script type="text/javascript">

        $(document).ready(function () {

            $("#bar_chart_v").change(function()
            {
                if ($(this).is(':checked')) {
                    $("#bar_chart_section").removeClass('d-none');
                }else{
                    $("#bar_chart_section").addClass('d-none');
                }
            });

            $("#radar_chart_v").change(function()
            {
                if ($(this).is(':checked')) {
                    $("#radar_chart_section").removeClass('d-none');
                }else{
                    $("#radar_chart_section").addClass('d-none');
                }
            });

            $('#sections').change(function () {

                var sections = $(this).val()
                //console.log(sections);

                //Show Bar Chart Field
                // if(sections > 0){
                //     $("#bar_chart").removeClass('d-none');
                // }else{
                //     $("#bar_chart").addClass('d-none');
                // }

                $('#label_container').empty();
                for(var x = 1; x <= sections; x++){
                    var fieldHTML = ' <div class="col-md-6"><div class="form-group"> <label class="required" for="label' + x + '">Section ' + x + ' Label</label><input class="form-control" type="text" name="sections_labels[' + x + ']" value="" id="sections_labels-' + x + '" required></div></div> <div class="col-md-6"><label class="required" for="label' + x + '">Section ' + x + ' Heading</label><input class="form-control" type="text" name="sections_headings[' + x + ']" value="" id="sections_headings-' + x + '" required></div></div> ';
                    $('#label_container').append(fieldHTML); //Add field html
                }

                if(sections==0 || sections=='0'){
                    var fieldHTML = ' <input class="form-control" type="hidden" name="sections_labels" value=""> <input class="form-control" type="hidden" name="sections_headings" value="">  ';
                    $('#label_container').append(fieldHTML); //Add field html
                }
            });
        });
    </script>


@endsection
