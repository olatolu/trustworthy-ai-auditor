@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>

                {!! Form::select('category_id', $categories, old('category_id', $question->category->id), ['class' => $errors->has('category') ? 'form-control select2 js-example-placeholder-single is-invalid' : 'form-control select2 js-example-placeholder-single', 'id'=>'category_id', 'required'=>'required', 'multiple' => false]) !!}

            @if($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="question_text">{{ trans('cruds.question.fields.question_text') }}</label>
                <textarea class="form-control {{ $errors->has('question_text') ? 'is-invalid' : '' }}" name="question_text" id="question_text" required>{{ old('question_text', $question->question_text) }}</textarea>
                @if($errors->has('question_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>

            @if($question->category->sections > 0)
            <div class="form-group">
                <label class="" for="section">{{ trans('cruds.question.fields.section') }}</label>
                <select class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section">
                    @for($i = 0; $i <= $question->category->sections; $i++)
                        @if($i == old('section', $question->section))
                            <option value="{{$i}}" selected="selected">{{$i}}</option>
                        @else
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                    @endfor
                </select>
                @if($errors->has('section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
                <input type="hidden" name="max-sections" value="{{$question->category->sections}}">
            </div>
            @elseif($errors->has('section'))

                <div class="form-group">
                    <label class="" for="section">{{ trans('cruds.question.fields.section') }}</label>
                    <input type="number" class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section" value="{{ old('section') }}">
                    @if($errors->has('section'))
                        <div class="invalid-feedback">
                            {{ $errors->first('section') }}
                        </div>
                    @endif
                </div>

            @endif


            <div class="form-group">
                <label class="" for="question_label">{{ trans('cruds.question.fields.question_label') }}</label>
                <input type="text" class="form-control {{ $errors->has('question_label') ? 'is-invalid' : '' }}" name="question_label" id="question_label" value="{{ old('question_label', $question->question_label) }}">
                @if($errors->has('question_label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_label') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.question.fields.order') }}</label>
                <input type="number" class="form-control {{ $errors->has('question_order') ? 'is-invalid' : '' }}" name="order" id="order" value="{{ old('order' ,$question->order) }}" required>
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
