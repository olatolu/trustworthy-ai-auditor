@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.result.title_singular') }} - {{$category->name}}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.results.update", [$result->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.result.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($result->user ? $result->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.user_helper') }}</span>

                <input type="hidden" name="category_id" value="{{$category->id}}">
            </div>

            @if($category->sections > 0)

                @php $qNumb = 1; @endphp

                @for($j = 1; $j<=$category->sections; $j++)

                <div class="card mb-3">
                    <div class="card-header">{{ $category->sections_headings->$j }}</div>

                    <div class="card-body">
                        @foreach($result->questions->where('section', $j)->sortBy('order') as $question)
                            <div class="card @if(!$loop->last)mb-3 @endif">
                                <div class="card-header"><b>{{$qNumb}}.</b> {{ $question->question_text }}</div>

                                <div class="card-body">
                                    <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                    @foreach($question->questionOptions as $option)
                                        <div class="form-check">
                                                <label class="form-check-label" for="option-{{ $option->id }}">
                                                    <input class="form-check-input" type="radio" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" value="question_id-{{$question->id}},option_id-{{$option->id}},point-{{$option->points}}" @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) checked @elseif($option->id == $question->pivot->option_id) checked @endif>
                                                    {{ $option->option_text }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @if($errors->has("questions.$question->id"))
                                        <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                        <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                                    </span>
                                    @endif
                                    @php $qNumb++ @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @endfor
            @endif
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
