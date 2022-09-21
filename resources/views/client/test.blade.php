@extends('layouts.client')

@section('content')
<div class="container">
    <section class="jumbotron text-center" style="background: url('/images/artificial-Intelligence-tools.jpeg'); background-position: center center;">
        <div class="container">
            <h1 class="text-white">{{ trans('panel.site_title') }}</h1>
            <p class="lead text-muted"></p>
            <p>
                <a href="#main" class="btn btn-primary my-2">Get Started</a>
{{--                <a href="{{ trans('panel.main_site') }}" class="btn btn-secondary my-2">Go To Home</a>--}}
            </p>
        </div>
    </section>

    <h4 class="text-center">CATEGORY OF ASSESSMENT</h4>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <a name="main"></a>

                @if(count($tests) > 0)

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>PROFILE - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS</title><rect width="100%" height="100%" fill="#acbecd"></rect><foreignObject x="5%" y="30%" fill="#fff" dy=".0em" width="90%" height="100%"><h5 class="card-text text-center" xmlns="http://www.w3.org/1999/xhtml"><a class="text-white text-decoration-none" href="{{route('profile.index',0)}}">PROFILE - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS</a></h5></foreignObject></svg>
                        <div class="card-body" style="padding: 0px; border: 0px; min-height: 0px;">
                        </div>
                        </div>
                    </div>

                    @foreach($tests as $test)
                        <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>{{$test->name}}</title><rect width="100%" height="100%" fill="{{$test->color()}}"/><foreignObject x="5%" y="30%" fill="#fff" dy=".0em" width="90%" height="100%"><h5 class="card-text text-center" xmlns="http://www.w3.org/1999/xhtml"><a class="text-white text-decoration-none" href="{{route('get.test.landing', $test->slug)}}">{{$test->name}}</a></h5></foreignObject></svg>
                        <div class="card-body" style="padding: 0px; border: 0px; min-height: 0px;">
{{--                            <h5 class="card-text"><i class="fa fa-calendar-times"></i> {{ \Carbon\Carbon::parse($test->start_at)->format('d M, Y h:i:s A')}}</h5>--}}
{{--                            <div class="d-flex justify-content-between align-items-center">--}}
{{--                                <div class="btn-group">--}}
{{--                                    <a href="{{route('get.test.landing', $test->slug)}}" class="btn btn-sm btn-outline-secondary">View</a>--}}
{{--                                    <a href="{{route('get.test.landing', $test->slug)}}" class="btn btn-sm btn-outline-secondary">{{count($test->categoryQuestions)}} Questions</a>--}}
{{--                                </div>--}}
{{--                                <small class="text-muted">{{($test->test_duration != 0 )? $test->test_duration." mins" : ''}}</small>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                    @endforeach
                @else
                <p>Not Record Found!</p>
                @endif

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$tests->render()}}
        </div>
    </div>

</div>
<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>&copy; 2020 All rights reserved | {{ trans('panel.site_title') }} </p>
    </div>
</footer>
@endsection
