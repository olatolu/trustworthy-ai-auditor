@extends('layouts.test')

@section('content')

  <div class="wrapper">
            <div class="steps-area steps-area-fixed">
                <div class="image-holder">
                    <img src="{{asset('app/assets/img/assessment-bg.jpg')}}" alt="{{$test->name}}">
                </div>
                <div class="steps clearfix">
                    <ul class="tablist multisteps-form__progress">

                        @if($test->sections > 0)

                            @for($i = 1; $i<=$test->sections; $i++)
                                <li class="multisteps-form__progress-btn @if($i==1)js-active current @elseif($i == $test->sections) last @endif">
                                    <span>{{$i}}</span>
                                </li>
                            @endfor

                        @endif
                    </ul>
                </div>

            </div>
            <form class="multisteps-form__form q_form" action="{{ route('client.test.store') }}" id="wizard" method="POST">
                @csrf
                <div class="form-content pera-content" style="padding-top: 0px;">
                    <h2 class="qheading text-center">{{$test->name}}</h2>
                    <!-- Schedule CountDown-->
                    @if($test->test_duration > 0)
                        <center>
                            <h4 class="mt-2">Time Remaining</h4>
                            <div id="qclockdiv" class="">
                                <div>
                                    <span class="days"></span>
                                    <div class="smalltext">Days</div>
                                </div>
                                <div>
                                    <span class="hours"></span>
                                    <div class="smalltext">Hours</div>
                                </div>
                                <div>
                                    <span class="minutes"></span>
                                    <div class="smalltext">Minutes</div>
                                </div>
                                <div>
                                    <span class="seconds"></span>
                                    <div class="smalltext">Seconds</div>
                                </div>
                            </div>
                            <div style="padding-top: 20px" class="container-fluid">
                                @if(session('message'))
                                    <div class="row mb-2">
                                        <div class="col-lg-12">
                                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if($errors->count() > 0)
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            <li>Some error occur, please check all the fields</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </center>
                    @endif
                </div>
                <div class="form-area position-relative">
                @if($test->sections > 0)

                    @php $qNumb = 1; @endphp

                    @for($j = 1; $j<=$test->sections; $j++)

                        <!-- div {{$j}} -->
                            <div class="multisteps-form__panel {{($j==1)? 'js-active':''}}" data-animation="slideHorz">
                                <div class="wizard-forms">
                                    <div class="inner clearfix">
                                        <div class="form-content pera-content">
                                            <div class="step-inner-content">
                                                <span class="step-no bottom-line">{{$j}} - {{ $test->sections_headings->$j }}</span>
                                                <div class="step-progress pt-2">
                                                    <span>{{$j}} of {{$test->sections}} completed</span>
                                                    <div class="step-progress-bar">
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width:40%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(count($errors)>0)
                                                    <div class="alert alert-danger" style="margin-top: 10px;">
                                                        <p>Some Errors occur, Please go through all the questions</p>
                                                    </div>
                                                @endif
                                                <!-- Questions & Options -->
                                                <input type="hidden" name="category_id" value="{{$test->id}}">

                                                <input type="hidden" class="f_submit" name="f_submit" value="0">

                                                <input type="hidden" class="t_remaining" name="t_remaining" value="0">

                                            @foreach($test->categoryQuestions->where('section', $j)->sortBy('order') as $question)

                                                    <h4 class="pt-3 question-list">{{$qNumb}}. {{$question->question_text}}</h4>
                                                    <div class="services-select-option">
                                                        <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                                        <ul class="opti-list">
                                                            @foreach($question->questionOptions->sortBy('order') as $option)
                                                                @if($option->points == 0)
                                                                    <li style="color: #d7d5d5;" class="bg-white @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) active @endif"><input type="radio" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" value="question_id-{{$question->id}},option_id-{{$option->id}},point-{{$option->points}}" @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) checked @endif>{{ $option->option_text }}</li>
                                                                @else
                                                                    <li style="color: #fff;" class="bg-white @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) active @endif"><input type="radio" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" value="question_id-{{$question->id}},option_id-{{$option->id}},point-{{$option->points}}" @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) checked @endif>{{ $option->option_text }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                        @if($errors->has("questions.$question->id"))
                                                            <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                        <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                            </span>
                                                        @endif
                                                    </div>

                                                    @php $qNumb++; @endphp

                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.inner -->
                                    @if($j < $test->sections)
                                        <div class="actions">
                                            <ul>
                                                @if($j == 1)
                                                    <li><a href="{{url('/')}}"><span class="js-btn-prev" title="BACK"><i class="fa fa-window-close"></i> CANCEL </span></a></li>
                                                @elseif($j > 1)
                                                    <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
                                                @endif
                                                <li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                            </ul>
                                        </div>
                                    @elseif($j == $test->sections)
                                        <div class="actions">
                                            <ul>
                                                <input type="hidden" name="profile" value="{{$profile}}">
{{--                                                <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>--}}
                                                <li><button type="submit" title="NEXT">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endfor

                    @elseif($test->sections == 0)

                        @php $qNumb = 1; @endphp
                        <div class="multisteps-form__panel js-active" data-animation="slideHorz">
                            <div class="wizard-forms">
                                <div class="inner clearfix">
                                    <div class="form-content pera-content">
                                        <div class="step-inner-content">
                                            <span class="step-no bottom-line">Step 1</span>
                                            <div class="step-progress float-right">
                                                <span>1 of 1 completed</span>
                                                <div class="step-progress-bar">
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width:40%"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Questions & Options -->
                                            <input type="hidden" name="category_id" value="{{$test->id}}">

                                            <input type="hidden" class="f_submit" name="f_submit" value="0">

                                            <input type="hidden" class="t_remaining" name="t_remaining" value="0">

                                            @foreach($test->categoryQuestions->sortBy('order') as $question)

                                                <h4 class="pt-5">{{$qNumb}}. {{$question->question_text}}</h4>
                                                <div class="services-select-option">
                                                    <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                                    <ul class="opti-list">
                                                        @foreach($question->questionOptions->sortBy('order') as $option)
                                                            <li class="bg-white @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) active @endif"><input type="radio" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" value="question_id-{{$question->id}},option_id-{{$option->id}},point-{{$option->points}}" @if(old("questions.$question->id") == 'question_id-'.$question->id.',option_id-'.$option->id.',point-'.$option->points) checked @endif>{{ $option->option_text }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @if($errors->has("questions.$question->id"))
                                                        <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                        <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                            </span>
                                                    @endif
                                                </div>

                                                @php $qNumb++; @endphp

                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <!-- /.inner -->
                                <div class="actions">
                                    <ul>
                                        <li><button type="submit" id="fsubmit" title="NEXT">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </form>

        </div>


@endsection

@push('top-scripts')

@endpush


@push('scripts')
    <script>

        window.onload = function(e) {
            var title = "{{$test->style}}";
            setActiveStyleSheet(title);
        }


        /****
         *
         *  TIMER
         * ***/


        function getTimeRemaining(endtime) {
            const total = Date.parse(endtime) - Date.parse(new Date());
            const seconds = Math.floor((total / 1000) % 60);
            const minutes = Math.floor((total / 1000 / 60) % 60);
            const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
            const days = Math.floor(total / (1000 * 60 * 60 * 24));

            return {
                total,
                days,
                hours,
                minutes,
                seconds
            };
        }

        function initializeClock(id, endtime, type) {
            const clock = document.getElementById(id);
            const daysSpan = clock.querySelector('.days');
            const hoursSpan = clock.querySelector('.hours');
            const minutesSpan = clock.querySelector('.minutes');
            const secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                const t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                $(".t_remaining").val(t.total);

                if (t.total <= 0) {
                    clearInterval(timeinterval);

                    if(type == 'ct_st') {

                        window.location = "{{url()->current()}}"
                    }

                    if(type == 'q_st') {

                        $(".f_submit").val(1);

                        sessionStorage.removeItem('reloaded');
                        //localStorage.removeItem('reloaded')

                        $('.q_form').submit();
                    }
                }
            }

            updateClock();
            const timeinterval = setInterval(updateClock, 1000);
        }

            @if((($test->test_duration > 0) && strtotime($dateNow) >= strtotime($test->start_at)) && (request()->has('q_st') && request()->has('q_st') ==$test->id))

        var countDown = "{{old('t_remaining', (int)$test->test_duration * 60 * 1000)}}";

        const deadline = new Date(Date.parse(new Date()) + countDown * 1 );

        initializeClock('qclockdiv', deadline, 'q_st');

            @else

        var countDown = '{{ strtotime($test->start_at) - strtotime($dateNow) }}';

        var dateNow = "{{$dateNow}}";

        const deadline = new Date(Date.parse(dateNow) + parseInt(countDown) * 1000);

        initializeClock('clockdiv', deadline, 'ct_st');

        @endif

            @if((strtotime($dateNow) >= strtotime($test->start_at)) && (request()->has('q_st') && request()->has('q_st') ==$test->id))

        if (sessionStorage.getItem('reloaded') != null) {

            @if(!$errors->count() > 0)
            alert('You have reloaded this page. The test is submitting automatically');
            $(".f_submit").val(1);

            sessionStorage.removeItem('reloaded');
            @endif

        } else {
            //console.log('page was not reloaded');
            sessionStorage.setItem('reloaded', 'yes'); // could be anything
        }

        @endif

        $('.q_form').submit(function() {
            sessionStorage.removeItem('reloaded');
        });
    </script>

@endpush
