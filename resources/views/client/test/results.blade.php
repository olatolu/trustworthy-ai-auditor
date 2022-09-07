@extends('layouts.test')

@section('content')

    <!-- Start of thank you section
		============================================= -->
    <section id="thank-you" class="thank-you-section">
        <div class="container">
            <div class="thank-you-wrapper position-relative thank-wrapper-style-two thank-wrapper-style-four">
                <!-- <div class="thank-you-close text-center">x</div> -->
                <div class="thank-txt text-center">
                    <div class="text-area-thank">
                        <div class="thank-icon">
                            <img src="/app/assets/img/tht4.png" alt="">
                        </div>
                        @if($result->category->c_room == 1)
                            <h1>Submitted Successfully</h1>
                        @else
                            <h1>Results of your Assessment</h1>
                            @if(session('status'))
                                <div class="alert alert-danger" role="alert">
                                    <p>{{ session('status') }}</p>
                                </div>
                             @else
                                <p>Click the button below to get report.</p>
                             @endif
                        @endif

                    </div>
                </div>
                <div class="thank-txt-part2">
                    @if($result->category->c_room == 1)
                    <div class="mt-5"></div>
                    @else
                    <div class="okey-btn text-uppercase text-center">
                        <a class="d-block" target="_blank" href="{{ route('report.get', $result->id) }}">GET REPORT NOW & BY EMAIL</a>
                    </div>
                    @endif
                    <span><img src="/app/assets/img/eni.png" alt="">{{ trans('panel.email') }}</span>
                    <span><img src="/app/assets/img/phi.png" alt="">{{ trans('panel.phone') }}</span>
                </div>
                <div class="thank-vectoritem thank-vector2 position-absolute"><img src="/app/assets/img/tv2.png" alt=""></div>
                <div class="thank-vectoritem thank-vector3 position-absolute"><img src="/app/assets/img/tv4.png" alt=""></div>
            </div>
            <p class="text-center"><a class="btn btn-success text-white mb-3" href="{{url('/')}}">Go Back Home</a></p>
        </div>
    </section>
    <!-- End of thank you section
        ============================================= -->

@endsection
