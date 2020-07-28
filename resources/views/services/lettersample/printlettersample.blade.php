@extends('layouts.pdf')
@section('title', 'Recommendation Letter')
@section('content')
<div id="container">
  <h6>
    MPD - 36/{{now()->year}}/…….. 
   <strong class="float-right">Date:{{ date('m/d/yy', strtotime(now())) }}</strong>
 </h6><br><br>
 <h6 class="text-center">TO WHOM IT MAY CONCERN </h6>
 <br><br>
  @if ($data->letter_type_id==1)
    <p class="text-justify">This is to certify that M/s.<strong>  {{ $data->owner_name }}</strong> is Royal Government of Bhutan’s licensed Tour Operator and registered with the Tourism Council of Bhutan. </p>
    <p class="text-justify">We would like to confirm that Mr/Ms <strong> {{  $data->owner_name }} </strong>  the proprietor of <strong> {{  $data->company_title_name }} </strong></p>
    <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($data->license_date)) }} </strong> (validity of the license) </p>  
  @endif

   @if ($data->letter_type_id==3)
        <p class="text-justify">This is to certify that M/s. <strong> {{  $data->owner_name }} </strong>  is Royal Government of Bhutan’s
          licensed Tour Operator and registered with the Tourism Council of
          Bhutan.  </p>
        <p class="text-justify">We would like to confirm that Mr. {{  $data->owner_name}} bearing passport number ….. is
          the Marketing Officer of the company. 
          </p>
        <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($data->license_date)) }} </strong> (validity of the license) </p>  
    @endif

    @if ($data->letter_type_id==4)
    <p class="text-justify">This is to certify that M/s.<strong> {{ $data->owner_name }} </strong> Royal Government of Bhutan’s
      licensed Tour Operator and registered with the Tourism Council of
      Bhutan. </p>
    <p class="text-justify">Mr/Ms. <strong>{{  $data->owner_name }}</strong>, Marketing Officer, bearing passport number ……. will
      be attending ……. organized by the …… scheduled for ……. 
      </p>
      <p class="text-justify">Therefore, the Council would like to request assistance for Mr/Ms.
        {{ $data->owner_name  }}. in obtaining visa for the proposed duration. 
        
        </p>
        <p class="text-justify">The company will pay the fees applicable. 
          </p>
    <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($data->license_date)) }} </strong> (validity of the license) </p>  
    @endif

    @if ($data->letter_type_id==2)
    <p class="text-justify">This is to certify that M/s. {{  $data->owner_name }} is Royal Government of Bhutan’s
      licensed Tour Operator and registered with the Tourism Council of
      Bhutan. 
      . </p>
    <p class="text-justify">The letter is valid till <strong> {{ date('d/m/Y', strtotime($data->license_date)) }} </strong> (validity of the license) </p>  
	@endif
	<br><br><br>
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