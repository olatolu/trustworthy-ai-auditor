<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Test No. </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    <style type="text/css">
        html {
            margin: 0;
        }
        body {
            background-color: #FFFFFF;
            font-size: 10px;
            margin: 36pt;
        }
    </style>
</head>
<body>
<p>I am here</p>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.js"></script>
<canvas id="myChart" width="400" height="400"></canvas>
<script type="text/javascript">
    var ctx = document.getElementById('myChart');
    var myRadarChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Running', 'Swimming', 'Eating', 'Cycling'],
            datasets: [{
                data: [50, 20, 10, 5]
            }]
        },
        options: {
            scale: {
                angleLines: {
                    display: false
                },
                ticks: {
                    suggestedMin: 50,
                    suggestedMax: 100
                }
            }
        }
    });
</script>
</body>
</html>


