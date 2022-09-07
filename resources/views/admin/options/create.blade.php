@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.option.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.options.store") }}" enctype="multipart/form-data">
            @csrf

         <div class="form-group">
            <label class="required" for="question_id">{{ trans('cruds.option.fields.question') }}</label>
            <input type="hidden" name="question_id" value="0">
             <div style="padding-bottom: 4px">
                 <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                 <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
             </div>

             {!! Form::select('questions[]', $questions, old('questions'), ['class' => $errors->has('questions') ? 'form-control select2 js-example-placeholder-multiple is-invalid' : 'form-control select2 js-example-placeholder-multiple', 'multiple' => true, 'id'=>'questions', 'required'=>'required']) !!}

            @if($errors->has('questions'))
                <div class="invalid-feedback">
                    {{ $errors->first('questions') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.option.fields.question_helper') }}</span>
    </div>

            <div class="form-group">
                <label class="required" for="option_text">{{ trans('cruds.option.fields.option_text') }}</label>
                <textarea class="form-control {{ $errors->has('option_text') ? 'is-invalid' : '' }}" name="option_text" id="option_text" required>{{ old('option_text') }}</textarea>
                @if($errors->has('option_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="points">{{ trans('cruds.option.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points') ?? 0 }}" step="1" required>
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.option.fields.points_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="option_label">{{ trans('cruds.option.fields.option_label') }}</label>
                <input class="form-control {{ $errors->has('option_label') ? 'is-invalid' : '' }}" type="text" name="option_label" id="option_label" value="{{ old('option_label') }}">
                @if($errors->has('option_label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_label') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.option.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order') ?? 0 }}" step="1">
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
