@extends('layouts.manager')
@section('page-title','New : Tourist Standard Hotel Assessment')
{{-- @include('layouts.include.alert_success') --}}
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Registration of Tourist Standard Hotels</h4>
  </div>
  <form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    @foreach ($idInfos as $idInfo)
    <input type="hidden" name="service_id" value="{{ $idInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfo->module_id }}" id="module_id">
    @endforeach 
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-5">
          <label>Registration Type <span class="text-danger">*</span></label>
          <select class="form-control" name="star_category_id" id="star_category_id">
            <option value="">-select-</option>
            @foreach ($starCategoryLists as $starCategoryList)
          <option value="{{$starCategoryList->star_category_id}}">{{$starCategoryList->star_category_name}}</option>
            @endforeach
          </select>
          <span class="text-danger">{{ $errors->first('star_category_id') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">License Number <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="license_no" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('license_no') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">License Date <span class="text-danger">*</span> </label>
          <input type="date" class="form-control" name="license_date" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('license_date') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="name" autocomplete="off">
          <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Owner <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="owner" autocomplete="off">
          <span class="text-danger">{{ $errors->first('owner') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Address <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="address" autocomplete="off">
          <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Contact No <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="contact_no" id="" autocomplete="off">
          <span class="text-danger">{{ $errors->first('contact_no') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Fax <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="fax" autocomplete="off">
          <span class="text-danger">{{ $errors->first('fax') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Email <span class="text-danger">*</span> </label>
          <input type="email" class="form-control" name="email" autocomplete="off">
          <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Internet Homepage <span class="text-danger">*</span> </label>
          <input type="text" class="form-control" name="internet_url" autocomplete="off">
          <span class="text-danger">{{ $errors->first('internet_url') }}</span>
        </div>
        <div class="form-group col-md-5">
          <label for="">Number of Beds <span class="text-danger">*</span> </label>
          <input type="number" class="form-control" name="bed_no" autocomplete="off">
          <span class="text-danger">{{ $errors->first('bed_no') }}</span>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Location <span class="text-danger">*</span> </label>
          <select class="form-control select2bs4" name="location_id">
            <option value="">-Select-</option>
            <option value="1">Tashigang</option>
          </select>
          <span class="text-danger">{{ $errors->first('location_id') }}</span>
        </div>
      </div>
      <!-- select room -->
      <h5>Room Details</h5>
      <div class="row">
        <div class="form-group col-md-5">
          <label>Room Type <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-5 offset-md-2">
          <label for="">Number of Room<span class="text-danger">*</span> </label>
        </div>
      </div>
      <div id="row">
      <div class="row">
        <div class="form-group col-md-5">
          <select class="form-control" name="room_type_id[]" id="room_type_id">
            <option value=""> -Select Room- </option>
            <option value="1">Single</option>
            <option value="2">Double</option>
            <option value="3">Suites</option>
          </select>
          <span class="text-danger">{{ $errors->first('room_type_id') }}</span>
        </div>
        <div class="form-group col-md-4 offset-md-2">
          <input type="text" class="form-control" name="room_no[]" autocomplete="off" id="room_no">
          <span class="text-danger">{{ $errors->first('room_no') }}</span>
        </div>
      </div>
    </div>
      <div id="adddiv"></div>
      <span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i></span>

      <!-- staff -->
      <h5>Staff Details</h5>
      <div class="row">
        <div class="form-group col-md-3">
            <label>Area <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-3">
            <label>Division <span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-3">
            <label for="">Name <span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-3">
            <label>Gender <span class="text-danger">*</span></label>
        </div>
      </div>
      <div id="row1">
        <div class="row">
        <div class="form-group col-md-3">
          <select class="form-control" name="staff_area_id[]" id="staff_area_id">
            <option value="">-select-</option>
            <option value="1">Lodging</option>
            <option value="2">Food & Beverage</option>
            <option value="3">Recreation,Other</option>
            <option value="4">Administration</option>
            <option value="5">Sales & Marketing</option>
            <option value="6">Pomec (Property Operation & Maintance)</option>
          </select>
          <span class="text-danger">{{ $errors->first('staff_area_id') }}</span>
        </div>
        <div class="form-group col-md-3">
          <select class="form-control" name="hotel_div_id" id="hotel_div_id">
            <option value="">-select-</option>
            <option value="1">Reception</option>
            <option value="2">Reservation</option>
            <option value="3">Front-Office</option>
            <option value="4">Housekeeping</option>
          </select>
          <span class="text-danger">{{ $errors->first('hotel_div_id') }}</span>
        </div>
        <div class="form-group col-md-3">
          <input type="text" class="form-control" name="staff_name[]" autocomplete="off" id="staff_name">
          <span class="text-danger">{{ $errors->first('staff_name') }}</span>
        </div>
        <div class="form-group col-md-2">
          <select class="form-control" name="staff_gender[]" id="staff_gender">
            <option value="">-select-</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
          <span class="text-danger">{{ $errors->first('staff_gender') }}</span>
        </div>
      </div>
      </div>
      <div id="field_wrapper1"></div>
        <span class="btn btn-success btn-sm float-right" id="add1"> <i class="fas fa-plus fa-sm">Add</i> </span>
      <div class="row">
        <div class="col-md-12">
          <p><span>Please attach additional sheets where necessary like pictures of buildings.</span></p>
          <div class="mb-3 mt-2">
            <span class="btn btn-success fileinput-button btn-sm">
              <i class="fas fa-plus fa-sm"></i>
              <span>Add files...</span>
              <!-- The file input field used as target for the file upload widget -->
              <input  type="file" name="file[]" id="file" multiple>
            </span>
          </div>
        </div>
      </div>
      <div id="showdivid"></div>
    </div> <!-- card body ends -->
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
      <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>    
  </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){ 
      id=1;
      $("#add").click(function(){
        $("#row").clone().attr('id', 'row'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
        $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove" onClick="removeForm('+id+')"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
        +'<div id="line'+id+'"></div>';
        $('#adddiv').append($addRow);
        id++;
      });
    });
  
    function removeForm(id){  
      if (confirm('Are you sure you want to delete this form?')){
        $('#row'+id).remove();
        $('#remove'+id).remove();
        $('#line'+id).remove();
      }
    }
    $(document).ready(function(){
    id1=1;
    $("#add1").click(function(){
      $("#row1").clone().attr('id', 'row1'+id1).after("#id").appendTo("#field_wrapper1").find("input[type='text']").val("");
      $addRow1 ='<div id="remove1'+id1+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove1" onClick="removeForm1('+id1+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
      +'<div id="line1'+id1+'"></div>';
      $('#field_wrapper1').append($addRow1);
      id1++;
    }); 
  });
  function removeForm1(id1){  
    if (confirm('Are you sure you want to delete this form?')){
      $('#row1'+id1).remove();
      $('#remove1'+id1).remove();
      $('#line1'+id1).remove();
    }
  }
  $(document).ready(function(){
      $('#star_category_id').on('change',function(ev){
        var star_category_id=$("#star_category_id").val();
		var url="{{ url('application/get-chapters') }}";
		var options = {target:'#showdivid',
        url:url,
        type:'POST',
        data: $("#formdata").serialize()};
        $("#formdata").ajaxSubmit(options);
      });
  });
</script>   
@endsection