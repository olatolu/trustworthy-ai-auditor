@extends('layouts.app')

@section('title') - {{$test->name}} | {{$result->id}} @endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
<style type="text/css">

    .timeline-steps {
        display: flex;
        justify-content: center;
        flex-wrap: wrap
    }

    .timeline-steps .timeline-step {
        align-items: center;
        display: flex;
        flex-direction: column;
        position: relative;
        margin: 1rem
    }

    @media (min-width:768px) {
        .timeline-steps .timeline-step:not(:last-child):after {
            content: "";
            display: block;
            border-top: .25rem dotted #0b58d4;
            width: 6.46rem;
            position: absolute;
            left: 8rem;
            top: .3125rem
        }

        .inner-circle .inner-content{
            position: absolute;
            color: #fff !important;
        }
        .timeline-steps .timeline-st:nth-child(1)ep:not(:first-child):before {
            content: "";
            display: block;
            border-top: .25rem dotted #3b82f6;
            width: 3.8125rem;
            position: absolute;
            right: 7.5rem;
            top: .3125rem
        }
    }

    .timeline-steps .timeline-content {
        width: 10rem;
        text-align: center
    }

    .timeline-steps .timeline-content .inner-circle {
        border-radius: 1.5rem;
        height: 1rem;
        width: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #3b82f6
    }

    .timeline-step:nth-child(1) .timeline-content .inner-circle:before {
        background-color: green;
    }

    .timeline-steps .timeline-content .inner-circle:before {
        content: "";
        background-color: #88c7cb;
        display: inline-block;
        height: 6rem;
        width: 6rem;
        min-width: 6rem;
        border-radius: 6.25rem;
    }

    .tb-bg-level-1{
        background-color: #ff0008 !important;
    }

    .tb-bg-level-2{
        background-color: #9f6604 !important;
    }

    .tb-bg-level-3{
        background-color: #ffb700 !important;
    }

    .tb-bg-level-4{
        background-color: #69ef1c !important;
    }

    .tb-bg-level-5{
        background-color: #107002 !important;
    }

    li strong{font-weight: bolder !important;}
     table td.rank span{
         display: block;
     }

    table td.rank span.green{
        color: green;
    }

    table td.rank span.red{
        color: red;
    }

</style>
@endsection

@section('top-script')
@endsection

@section('content')

<div class="col-md-12 mt-2">
    <div class="card">
        <div class="card-body">

            <div class="container">
                <div class="row text-center justify-content-center mb-3">
                    <div class="col-md-12 pb-3">
                        <h2 class="font-weight-bold">REPORT - NEW TRUSTWORTHY AI APPLICATIONS AND STANDARDS</h2>
                        <h4 class="text-muted">MODERATION PROCESS – INTERNAL REVIEW AND VALIDATION</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                    <div class="inner-circle"><span class="inner-content">Complete</span></div>
                                    <p class="h6 mt-3 mb-1">NEW SCORING AND RANKING</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0"></p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                                    <div class="inner-circle"><span class="inner-content">Ongoing</span></div>
                                    <p class="h6 mt-3 mb-1">REVIEW</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0"></p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                                    <div class="inner-circle"><span class="inner-content">Next</span></div>
                                    <p class="h6 mt-3 mb-1">APPROVAL</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0"></p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                                    <div class="inner-circle"><span class="inner-content">Planned</span></div>
                                    <p class="h6 mt-3 mb-1">PUBLISH</p>
                                    <p class="h6 text-muted mb-0 mb-lg-0"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row justify-content-center pt-3">
            <!-- Left Column -->
            <div class="col-md-12 mb-5">
                <h3 class="text-center">PROVISIONAL TRUSTWORTHY QOUTIENT SCORE</h3>


                <table class="table table-bordered w-75 ml-auto mr-auto">
                    <thead>
                    <tr class="bg-primary">
                        <th scope="col"></th>
                        <th scope="col">Technology TQ</th>
                        <th scope="col">Legal and Ethical TQ</th>
                        <th scope="col">Overall Quotient (TQ Grade)</th>
                        <th scope="col">Overall Rank ID</th>
                        <th scope="col">Gain / Loss in Rank</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-info">
                        <td>Trustworthy Quotient (TQ) of AI Applications</td>
                        <td>{{$section_1_score_percent}}%</td>
                        <td>{{$section_2_score_percent}}%</td>
                        <td>{{$over_all_percent}}%</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                <div class="p-2 w-75 mr-auto ml-auto">
                    <h5 class="font-weight-bold">RECOMMENDED ACTIONS</h5>
                    <p>This is a provisional report and is subject to moderation and approval based on qualitative assessment or audit. The final ranking of the new toolkit is published after internal review, validation and approval.</p>
                </div>
            </div>

        </div>
        </div>

    </div>
</div>

    @endsection

    @section('scripts')


    @endsection


