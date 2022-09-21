@extends('layouts.app')

@section('title')REPORT - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS - Register @endsection

@section('styles')

    <style>
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
@section('content')
    <div class="col-md-12 mt-2">
        <div class="card mx-2">
            <div class="card-body p-2 w-75 ml-auto mr-auto">

                <h4 class="p-2">REPORT - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS</h4>
                <table class="table table-hover table-bordered table-responsive">
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
                    <h5 class="font-weight-bold">RECOMMENDED ACTIONS</h5>
                    <p>This report is generic and subject to change, kindly undertake the organizational readiness assessment for a full and personalized report. <br>Thank you</p>
                </div>
            </div>

        </div>
    </div>


        @endsection


