@extends('layouts.manager')
@section('content')
<div class="p-3 mb-3">
    <div class="row">
      <div class="col-12">
        <h6>
           MPD - 36/{{now()->year}}/…….. 
          <strong class="float-right">Date:{{ date('m/d/yy', strtotime(now())) }}</strong>
        </h6>
      </div>
    </div><br><br>
    <div class="row">
        <div class="col-12">
            <h6 class="text-center">TO WHOM IT MAY CONCERN </h6>
        </div>
    </div><br><br><br>
    <div class="row">
      <div class="col-12">
        @if ($letterType==1)
        <p class="text-justify">This is to certify that M/s.<strong>  {{ $name }}</strong> is Royal Government of Bhutan’s licensed Tour Operator and registered with the Tourism Council of Bhutan. </p>
        <p class="text-justify">We would like to confirm that Mr/Ms <strong> {{ $name }} </strong>  the proprietor of <strong> {{ $companyName }} </strong></p>
        <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($licenseValidatyDate)) }} </strong> (validity of the license) </p>  
        @endif
        @if ($letterType==3)
        <p class="text-justify">This is to certify that M/s. <strong> {{ $name }} </strong>  is Royal Government of Bhutan’s
          licensed Tour Operator and registered with the Tourism Council of
          Bhutan.  </p>
        <p class="text-justify">We would like to confirm that Mr. {{ $name }} bearing passport number ….. is
          the Marketing Officer of the company. 
          </p>
        <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($licenseValidatyDate)) }} </strong> (validity of the license) </p>  
        @endif
        @if ($letterType==4)
        <p class="text-justify">This is to certify that M/s.<strong> {{ $name }} </strong> Royal Government of Bhutan’s
          licensed Tour Operator and registered with the Tourism Council of
          Bhutan. </p>
        <p class="text-justify">Mr/Ms. <strong>{{ $name }}</strong>, Marketing Officer, bearing passport number ……. will
          be attending ……. organized by the …… scheduled for ……. 
          </p>
          <p class="text-justify">Therefore, the Council would like to request assistance for Mr/Ms.
            {{ $name }}. in obtaining visa for the proposed duration. 
            
            </p>
            <p class="text-justify">The company will pay the fees applicable. 
             
              </p>
        <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($licenseValidatyDate)) }} </strong> (validity of the license) </p>  
        @endif
        @if ($letterType==2)
        <p class="text-justify">This is to certify that M/s. {{ $name }} is Royal Government of Bhutan’s
          licensed Tour Operator and registered with the Tourism Council of
          Bhutan. 
          . </p>
        <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($licenseValidatyDate)) }} </strong> (validity of the license) </p>  
        @endif
      
     </div>
    </div><br><br>
    <div class="row mr-3">
      <div class="col-12">
        <p class="float-right">
            <strong> (Damcho Rinzin)  </strong>  <br>
            <strong>Official Seal</strong>
            </p>
      </div>
    </div>
</div>
@endsection