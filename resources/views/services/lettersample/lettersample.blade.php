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
        <p class="text-justify">This is to certify that M/s.<strong>  {{ $name }}</strong> is Royal Government of Bhutan’s licensed Tour Operator and registered with the Tourism Council of Bhutan. </p>
      <p class="text-justify">We would like to confirm that Mr/Ms <strong> {{ $companyName }} </strong>  the proprietor of</p>
         <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($licenseValidatyDate)) }} </strong> (validity of the license) </p>
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