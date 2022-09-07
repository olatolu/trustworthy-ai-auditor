<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$test->name}} - {{ $result->id }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    <script src="{{ asset('app/assets/js/html2pdf.bundle.min.js') }}"></script>

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

    <style type="text/css">

        html {
            margin: 0;
        }

        body {
            background-color: #FFFFFF;
            font-size: 15px;
            margin: 26pt;
            font-family: sans-serif !important;
            max-width: 100% !important;
            padding-right: 10%;
            padding-left: 10%;
        }

        /*.chartContainer {*/
        /*    position: relative;*/
        /*    margin: auto;*/
        /*    height: 90vh;*/
        /*    width: 90vh;*/
        /*}*/

        /*svg {*/
        /*    overflow: visible !important;*/
        /*    height: 600px !important;*/
        /*}*/

        /*li{margin-bottom: 20px;}*/

        li strong{font-weight: bolder !important;}
    </style>
</head>
<body>
<button onclick="generatePDF()" id="pdf" class="btn btn-primary mb-3">Download as PDF</button>
<a href="{{url('/')}}" class="btn btn-secondary mb-3">Go Back Home</a>

<div id="content">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://rawgit.com/gliffy/canvas2svg/master/canvas2svg.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <table class="table table-bordered table-responsive">
        <thead>
        <!-- Report Header -->
        <tr>
            <th>{!! $test->short_description !!}</th>
        </tr>
        </thead>
        <tbody>
        @if($test->sections > 0 && $test->radar_chart == 1)
            <tr>
                <td>
                    <center>
                            <div class="chartContainer">
                                <canvas id="myChart" width="900" height="400"></canvas>
                            </div>
                            Fig. 1: Radar Chart of <span id="text">{{$test->name}}</span>
                    </center>

                </td>
            </tr>

            <tr>
                <td>
                    {!! $test->radar_report_header ?? '' !!}

                    @if($radarReportData !=null && count($radarReportData)>0)
                        @foreach($radarReportData as $radarReport)
                            {!! $radarReport !!}
                        @endforeach
                    @endif

                    {!! $test->radar_report_footer ?? '' !!}
                </td>
            </tr>
        @endif

        @if($test->bar_chart == 1 && $test->bar_chart_section > 0)
            <tr>
                <td>
                        <center>
                            <div id="barChart" style="width: 900px; height: 600px;"></div>
                        </center>
                        @foreach($barQuestions as $question)

                            <li><strong>{{($question->question_label != null)? $question->question_label : $test->sections_labels->$bar_chart_section."  (Q".$question->id.")"}} : </strong>{{$question->question_text}}</li>

                        @endforeach
                </td>
            </tr>
        @endif

        <!-- Report Footer -->

        <tr>
            <td>{!! $description !!}</td>
        </tr>

        </tbody>
    </table>

    @if($test->bar_chart == 1 && $test->bar_chart_section > 0)

        <script type="text/javascript">
            google.charts.load('current', {'packages': ['bar']});
            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                    ['{{$bar_label}}', 'Score'],
                        @foreach($barData as $key=>$data)

                    ["{{$data}}", {{$key}}],

                    @endforeach

                ]);

                var options = {
                    title: '{{$bar_label}}',
                    width: 900,
                    legend: {position: 'none'},
                    chart: {
                        title: '{{$bar_label}}',
                        subtitle: ''
                    },
                    bars: 'vertical', // Required for Material Bar Charts.

                    bar: {groupWidth: "90%"}
                };

                var chart = new google.charts.Bar(document.getElementById('barChart'));
                chart.draw(data, options);
            };
        </script>

    @endif

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
                    label: "{{$user->name}}",
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
</div>
</body>
</html>


