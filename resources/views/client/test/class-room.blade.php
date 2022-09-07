<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$test->name}} - Class Room</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
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
    <table class="table table-bordered table-responsive-sm">
        <thead>
        <!-- Report Header -->
        <tr>
            <th style="text-align: center;">{!! $test->short_description !!}</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th style="background-color: red; text-align: center;">SCORE 1-4 ({{$grades[0]}}%)</th>
                            <th style="background-color: yellow; text-align: center;">SCORE 5-7 ({{$grades[1]}}%)</th>
                            <th style="background-color: #66a903; text-align: center;">SCORE 8-10 ({{$grades[2]}}%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="background-color: red; text-align: center;">There is potential trouble. The organization does not have a culture of innovation. Regardless of the current market position, the future headed down the path of inconsequence.</td>
                            <td style="background-color: yellow; text-align: center;">The organization has the potential to for high innovation IQ and a stable culture of innovation.</td>
                            <td style="background-color: #66a903; text-align: center;">The organization has a working environment where innovation has the best chance of success, and has mobilized the power of the entire organization to create new customer value</td>
                        </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        <tr>
            <td>{!! $test->description !!}</td>
        </tr>
        </tbody>
    </table>


</div>
</body>
</html>


