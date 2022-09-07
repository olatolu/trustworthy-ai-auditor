@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.question.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="question_text">{{ trans('cruds.question.fields.question_text') }}</label>
                <textarea class="form-control {{ $errors->has('question_text') ? 'is-invalid' : '' }}" name="question_text" id="question_text" required>{{ old('question_text') }}</textarea>
                @if($errors->has('question_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="" for="section">{{ trans('cruds.question.fields.section') }}</label>
                <input type="number" class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section" value="{{ old('section') }}">
                @if($errors->has('section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="" for="question_label">{{ trans('cruds.question.fields.question_label') }}</label>
                <input type="text" class="form-control {{ $errors->has('question_label') ? 'is-invalid' : '' }}" name="question_label" id="question_label" value="{{ old('question_label') }}">
                @if($errors->has('question_label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_label') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.question.fields.order') }}</label>
                <input type="number" class="form-control {{ $errors->has('question_order') ? 'is-invalid' : '' }}" name="order" id="order" value="{{ old('order') ?? 0 }}" required>
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
