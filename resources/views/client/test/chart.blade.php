<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$test->name}} - {{ $result->id }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    <style type="text/css">

        html {
            margin: 0;
        }

        body {
            background-color: #FFFFFF;
            font-size: 15px;
            margin: 26pt;
            font-family: sans-serif !important;
        }

        .chartContainer {
            position: relative;
            margin: auto;
            height: 90vh;
            width: 90vh;
        }

        svg {
            overflow: visible !important;
            height: 600px !important;
        }

        li{margin-bottom: 10px;}

        li strong{font-weight: bolder !important;}
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://rawgit.com/gliffy/canvas2svg/master/canvas2svg.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>{!! $test->short_description !!}</th>
    </tr>
    </thead>
    <tbody>
    @if($test->sections > 0 && $test->radar_chart == 1)
    <tr>
        <td>
            <center>
                    <div id="SVG-container-name"></div>
                    Fig. 1: Radar Chart of <span id="text">{{$test->name}}</span>
            </center>

        </td>
    </tr>

    <tr>
        <td>{!! $description !!}</td>
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


    </tbody>
</table>
<div class="chartContainer">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

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

        var marksData = {
            labels: [
                @foreach($radarLabels as $label)
                    "{{$label}}",
                @endforeach
            ],
            datasets: [{
                label: "{{$user->name}}",
                backgroundColor: "transparent",
                borderColor: "rgba(200,0,0,0.6)",
                fill: false,
                radius: 6,
                pointRadius: 6,
                pointBorderWidth: 3,
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

        var graphData = {
            type: 'radar',
            data: marksData,
            options: chartOptions
        }

        function tweakLib() {
            C2S.prototype.getContext = function (contextId) {
                if (contextId == "2d" || contextId == "2D") {
                    return this;
                }
                return null;
            }

            C2S.prototype.style = function () {
                return this.__canvas.style
            }

            C2S.prototype.getAttribute = function (name) {
                return this[name];
            }

            C2S.prototype.addEventListener = function (type, listener, eventListenerOptions) {
                console.log("canvas2svg.addEventListener() not implemented.")
            }
        }


        var context = document.getElementById("myChart").getContext("2d");

        var radarChart = new Chart(context, graphData); // Works fine

        // tweak the lib according to sspecht @ https://stackoverflow.com/questions/45563420/exporting-chart-js-charts-to-svg-using-canvas2svg-js
        tweakLib();
        // deactivate responsiveness and animation
        graphData.options.responsive = false;
        graphData.options.animation = false;

        // canvas2svg 'mock' context
        var svgContext = C2S(900, 600);


        // new chart on 'mock' context fails:
        var mySvg = new Chart(svgContext, graphData);
        // Failed to create chart: can't acquire context from the given item

        //console.log(svgContext.getSerializedSvg(true));

        document.getElementById("SVG-container-name").innerHTML = svgContext.getSerializedSvg(true);

    </script>
@endif
</body>
</html>


