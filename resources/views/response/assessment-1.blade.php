@extends('layouts.app')

@section('title') - {{$test->name}} | {{$result->id}} @endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
<style type="text/css">

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
    <script>
        function generatePDF() {
            // Choose the element that our invoice is rendered in.
            document.getElementById("pdf").innerHTML = "Processing ...";
            var element = document.getElementById('content');
            var opt = {
                margin:       0.3,
                filename:     '{{$filename}}',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'landscape' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
            setTimeout(function () {
                document.getElementById("pdf").innerHTML = "Report Downloaded!";
            }, 5000);

        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://rawgit.com/gliffy/canvas2svg/master/canvas2svg.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('content')
{{--<button onclick="generatePDF()" id="pdf" class="btn btn-primary mb-3">Download as PDF</button>--}}
{{--<a href="{{url('/')}}" class="btn btn-secondary mb-3">Go Back Home</a>--}}

<div class="col-md-12 mt-2">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-auto">

                <table class="table">
        <thead>
        <!-- Report Header -->
        <tr>
            <th><center>REPORT: ORGANIZATIONAL READINESS FOR TRUSTWORTHY AI AND STANDARDS</center></th>
        </tr>
        </thead>
        <tbody>
        @if($test->sections > 0 && $test->radar_chart == 1)
            <tr>
                <td>
                    <center>
                        <h6 style="font-size: 14px !important; font-weight: bolder; margin-bottom: 10px;">READINESS STANDARDS ANALYTIC</h6>
                            <div class="chartContainer">
                                <canvas id="myChart" width="900" height="400"></canvas>
                            </div>
                    </center>

                </td>
            </tr>

        @endif

        </tbody>
    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-center p-2 w-75 ml-auto mr-auto">
            <!-- Left Column -->
            <div class="col-md-12 mb-5">
                <h6 style="font-size: 14px !important; font-weight: bolder; margin-bottom: 10px; text-align: center;">ORGANIZATIONAL READINESS LEVEL</h6>
                <table class="table table-bordered justify-content-center w-50 m-auto">
                    <thead>
                    <tr>
                        <th scope="col" class="tb-bg-level-1">LEVEL 1</th>
                        <th scope="col" class="tb-bg-level-2">LEVEL 2</th>
                        <th scope="col" class="tb-bg-level-3">LEVEL 3</th>
                        <th scope="col" class="tb-bg-level-4">LEVEL 4</th>
                        <th scope="col" class="tb-bg-level-5">LEVEL 5</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="tb-bg-level-1">Reactive</td>
                        <td class="tb-bg-level-2">Dispersed</td>
                        <td class="tb-bg-level-3">Organizational Defined</td>
                        <td class="tb-bg-level-4">Quantitatively Defined</td>
                        <td class="tb-bg-level-5">Optimizing</td>
                    </tr>
                    <tr>
                        <td class="tb-bg-level-1">< 20%</td>
                        <td class="tb-bg-level-2">21% - 40%</td>
                        <td class="tb-bg-level-3">41% - 60%</td>
                        <td class="tb-bg-level-4">61% - 80%</td>
                        <td class="tb-bg-level-5">81% - 100%</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">READINESS SCORE = <span class="font-weight-bold">{{$score_percent}}%</span></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">READINESS LEVEL = <span class="font-weight-bold">{{$level}}</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- RIGHT Column -->
            <div class="col-md-12">
                <h6 style="font-size: 14px !important; font-weight: bolder; margin-bottom: 10px; text-align: center;">RECOMMENDED TRUSTWORTHY AI TOOLKITS AND GUIDELINES</h6>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Toolkit Name/Title/Acronym</th>
                        <th scope="col">Rank Update</th>
                        <th scope="col">Year of Release</th>
                        <th scope="col">Industry/ Sector (Generic)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>a3i the Trust in AI Framework</td>
                        <td class="rank"><span class="green">+ 0.70%</span><span class="red">- 2 places</span> </td>
                        <td>2021</td>
                        <td>Academia</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>AI Now Institute Algorithmic Accountability Policy Toolkit</td>
                        <td class="rank"><span class="green">+ 0.30%</span><span class="red">- 3 places</span> </td>
                        <td>2021</td>
                        <td>Government</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>AI-RFX Procurement Framework</td>
                        <td class="rank"><span class="red">+ 0.80%</span><span class="red">- 1 place</span> </td>
                        <td>2019</td>
                        <td>FP: For-Profit</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>FactSheets: Increasing Trust in AI Services through supplier’s declarations of conformity</td>
                        <td class="rank"><span class="green">+ 10.00%</span><span class="green">- 2 places</span> </td>
                        <td>2021</td>
                        <td>NFP: Not-For-Profit</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Humans in AI Trello Board</td>
                        <td class="rank"><span class="green">+ 0.10%</span><span class="red">- 2 places</span> </td>
                        <td>2018</td>
                        <td>Academia</td>
                    </tr>

                    <tr>
                        <th scope="row">6</th>
                        <td>Diakopoulos  et al. Principles for Accountable Algorithms and Statement for algorithms</td>
                        <td class="rank"><span class="green">+ 0.20%</span><span class="red">- 3 places</span> </td>
                        <td>2019</td>
                        <td>Government</td>
                    </tr>

                    <tr>
                        <th scope="row">7</th>
                        <td>Algorithm Tips - Resources and Leads for investigating algorithms in society</td>
                        <td class="rank"><span class="red">+ 0.40%</span><span class="red">- 1 place</span> </td>
                        <td>2019</td>
                        <td>FP: For-Profit</td>
                    </tr>

                    <tr>
                        <th scope="row">8</th>
                        <td>DotEveryone. The Consequence Scanning Event</td>
                        <td class="rank"><span class="green">+ 20.0%</span><span class="green">- 2 places</span> </td>
                        <td>2021</td>
                        <td>NFP: Not-For-Profit</td>
                    </tr>

                    <tr>
                        <th scope="row">9</th>
                        <td>Epstein (2018) TuringBox: An experimental Platform for the evaluation of AI systems</td>
                        <td class="rank"><span class="green">+ 0.20%</span><span class="red">- 2 places</span> </td>
                        <td>2018</td>
                        <td>Academia</td>
                    </tr>

                    <tr>
                        <th scope="row">10</th>
                        <td>Friedman et al (2017) a survey of value sensitive design methods</td>
                        <td class="rank"><span class="red">+ 0.30%</span><span class="red">- 1 place</span> </td>
                        <td>2017</td>
                        <td>Government</td>
                    </tr>

                    </tbody>
                </table>
                <div class="p-2">
                    <h6 style="font-size: 14px !important; font-weight: bolder; margin-bottom: 10px; text-align: center;">RECOMMENDED ACTIONS</h6>
                    <p>This is a provisional report and is subject to moderation and approval after qualitative assessment or audit.</p>
                </div>
            </div>
        </div>

    </div>
</div>

    @endsection

    @section('scripts')

    @if($test->sections > 0 && $test->radar_chart == 1)
        <script type="text/javascript">

            var marksCanvas = document.getElementById("myChart");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            var marksData = {
                labels: [
                    @foreach($radarLabels as $label)
                        "{{$label}}",
                    @endforeach
                ],
                datasets: [{
                    label: "",
                    backgroundColor: "rgba(200,0,0,0.6)",
                    borderColor: "rgba(200,0,0,0.6)",
                    fill: false,
                    radius: 6,
                    pointRadius: 6,
                    pointBorderWidth: 1,
                    pointBackgroundColor: "orange",
                    pointBorderColor: "rgba(200,0,0,0.6)",
                    pointHoverRadius: 10,
                    data: [
                        @foreach($radarData as $point)
                        {{$point}},
                        @endforeach
                    ]
                }]
            };

            var chartOptions = {
                scale: {
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: 5,
                        stepSize: 1
                    },
                    pointLabels: {
                        fontSize: 12
                    }
                },
                legend: {
                    position: 'left'
                }
            };

            var radarChart = new Chart(marksCanvas, {
                type: 'radar',
                data: marksData,
                options: chartOptions
            });

        </script>
    @endif

    @endsection


