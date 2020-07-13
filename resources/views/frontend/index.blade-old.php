@extends('frontend/layouts/template')
@section('content')
<div class="col-8 offset-md-2 d-flex justify-content-center mb-3">
    <h5 class="display-4">Bhutan Tourism Dashboard</h5>
</div>
<div class="container text-bold h5">
    <div class="col-8 offset-md-2 d-flex justify-content-center mb-3">
        Two special modules present data on the impact of COVID 19 on tourism as well as a Policy Tracker on Measures to Support Tourism
    </div>
    <div class="row d-flex justify-content-center  pt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        INTERNATIONAL TOURISM 2020
                        <div class="h6">
                            International Tourist Arrivals
                        </div>
                    </div>
                    <img src="{{ URL::to ('img/tcblogo/wm.png') }}" class="w-100">
                    <br>
                    <ul class="h6">
                        <li><small>Loss of 850 million to 1.1 billon international tourists</small></li>
                        <li><small>Loss of US$ 910 billion to US$ 1.2 trillion in export revenues from tourism</small></li>
                        <li><small>100 to 120 million jobs at risk</small></li>
                    </ul>

                    <div class="text-center p-4">
                        <div class="btn btn-sm btn-outline-info">
                            Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        REGIONAL TOURISM 2020
                        <div class="h6">
                            Regional Tourist Arrivals
                        </div>
                    </div>
                    <!-- <span style="background-image: url('{{ asset('img/tcblogo/wm.png')}}');"></span> -->
                    <img src="{{ URL::to ('img/tcblogo/saarc.png') }}" class="w-100">
                    <br>
                    <small style="font-size: 12px;">
                        This compilation of country and international policy responses aims to share and monitor worldwide measures to mitigate the effects of COVID-19 crisis in the travel and tourism sector and accelerate recovery.
                    </small>

                    <div class="text-center p-4">
                        <div class="btn btn-sm btn-outline-info">
                            Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3 pt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        ACCOMODATION
                        <div class="h6">
                            Demand and Capacity
                        </div>
                    </div>
                    <!-- <span style="background-image: url('{{ asset('img/tcblogo/wm.png')}}');"></span> -->
                    <img src="{{ URL::to ('img/tcblogo/stay.png') }}" class="w-100">
                    <br>
                    <ul class="h6">
                        <li><small>Loss of 850 million to 1.1 billon international tourists</small></li>
                        <li><small>Loss of US$ 910 billion to US$ 1.2 trillion in export revenues from tourism</small></li>
                        <li><small>100 to 120 million jobs at risk</small></li>
                    </ul>

                    <div class="text-center p-4">
                        <div class="btn btn-sm btn-outline-info">
                            Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        TOURISM EMPLOYMENT
                        <div class="h6">
                            Tourism Employment Sector
                        </div>
                    </div>
                    <!-- <span style="background-image: url('{{ asset('img/tcblogo/wm.png')}}');"></span> -->
                    <img src="{{ URL::to ('img/tcblogo/emp.png') }}" class="w-100">
                    <br>
                    <small style="font-size: 12px;">
                        This compilation of country and international policy responses aims to share and monitor worldwide measures to mitigate the effects of COVID-19 crisis in the travel and tourism sector and accelerate recovery.
                    </small>

                    <div class="text-center p-4">
                        <div class="btn btn-sm btn-outline-info">
                            Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="text-center h1 p-4">
        TOUCH POINTS
    </div>
    <div class="row p-2">
        <div class="col text-center">
            <i class="fa fa-line-chart fa-5x text-secondary" aria-hidden="true"></i>
            <br>
            <h4>Toursim Dashboard</h4>
            More Info <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </div>
        <div class="col text-center">
            <i class="fa fa-graduation-cap fa-5x text-secondary" aria-hidden="true"></i>
            <br>
            <h4>Guides Portal</h4>
            More Info <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </div>
        <div class="col text-center">
            <i class="fa fa-pagelines fa-5x text-secondary" aria-hidden="true"></i>
            <br>
            <h4>Development</h4>
            More Info <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </div>
        <div class="col text-center">
            <i class="fa fa-cc-visa fa-5x text-secondary" aria-hidden="true"></i>
            <br>
            <h4>Tashel Online</h4>
            More Info <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </div>
    </div>
</div>
@endsection
