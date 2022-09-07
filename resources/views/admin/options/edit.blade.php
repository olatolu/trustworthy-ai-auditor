@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.option.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.options.update", [$option->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="questions">{{ trans('cruds.option.fields.question') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <input type="hidden" name="question_id" value="0">

                {!! Form::select('questions[]', $questions, old('questions') ? old('questions') : $option->questions->pluck('id')->toArray(), ['class' => $errors->has('questions') ? 'form-control select2 is-invalid' : 'form-control select2', 'multiple' => true, 'id'=>'questions', 'required'=>true]) !!}


            @if($errors->has('questions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('questions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.option.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="option_text">{{ trans('cruds.option.fields.option_text') }}</label>
                <textarea class="form-control {{ $errors->has('option_text') ? 'is-invalid' : '' }}" name="option_text" id="option_text" required>{{ old('option_text', $option->option_text) }}</textarea>
                @if($errors->has('option_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="points">{{ trans('cruds.option.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', $option->points) }}" step="1" required>
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.option.fields.points_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="option_label">{{ trans('cruds.option.fields.option_label') }}</label>
                <input class="form-control {{ $errors->has('option_label') ? 'is-invalid' : '' }}" type="text" name="option_label" id="option_label" value="{{ old('option_label', $option->option_label) }}">
                @if($errors->has('option_label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_label') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.option.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order', $option->order) }}" step="1">
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
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
