@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tourist Standard Hotels')
{{-- @include('layouts.include.alert_success') --}}
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Registration Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($starCategoryLists as $starCategoryList)
                        <option value="{{$starCategoryList->id}}">{{$starCategoryList->star_category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">License Number <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">License Date <span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="license_date" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Hotel Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Address <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control numeric-only" name="contact_no" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control email" name="email" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Fax No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="fax" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Beds <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control numeric-only" name="number" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Location <span class="text-danger">*</span> </label>
                    <select class="form-control select2bs4" name="location_id">
                        <option value="">- Select -</option>
                        @foreach ($locations as $location)
                        <option value="{{$location->id}}">{{$location->location_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Room Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Room Type <span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Room<span class="text-danger">*</span> </label>
                </div>
            </div>
            <div class="row" id="rowId">
                <div class="form-group col-md-5">
                    <select class="form-control netEmp" name="room_type_id[]" id="room_type_id">
                        <option value=""> - Select Room - </option>
                        @foreach ($roomTypeLists as $roomTypeList)
                        <option value="{{ $roomTypeList->id }}">{{ $roomTypeList->room_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 offset-md-2 ">
                    <input type="text" class="form-control" name="room_no[]" autocomplete="off" id="room_no">
                </div>
            </div>
            <div id="adddiv"></div>
            <span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i></span><br>
            <!-- staff -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Staff Details</h4>
        </div>
        <div class="card-body">
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
            <div class="row addmorerows" id="addstaff">
                <div class="form-group col-md-3">
                    <select class="form-control" name="staff_area_id[]" id="staff_area_id" onchange="selectStaffArea(this)">
                        <option value="">- Select -</option>
                        @foreach ($staffAreaLists as $staffAreaList)
                        <option value="{{ $staffAreaList->id }}"> {{ $staffAreaList->staff_area_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control" name="hotel_div_id[]" id="hotel_div_id">
                        <option value="">- Select -</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="staff_name[]" autocomplete="off" id="staff_name">
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="staff_gender[]" id="staff_gender">
                        <option value="">- Select -</option>
                        @foreach (config()->get('settings.gender') as $k => $v)
                        <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="field_wrapper1"></div>
            <span class="btn btn-success btn-sm float-right" id="add_more"> <i class="fas fa-plus fa-sm">Add</i> </span>
        </div>
    </div>
    <div id="showdivid"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>Please attach additional sheets where necessary like pictures of buildings</em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
    $('.select2bs4').on('change', function () {
        $(this).valid();
        });
    });
    
    $(document).ready(function(){ 
      id=1;
      $("#add").click(function(){
        $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
        $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove" onClick="removeForm('+id+')"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
        +'<div id="line'+id+'"></div>';
        $('#adddiv').append($addRow);
        id++;
        $('.netEmp').each(function() {
                    $(this).rules('add', {
                        required: true,
                        messages: {
                            required: 'this is a must requried field'
                        }
                    });
                });
      });
    });
  
    function removeForm(id){  
      if (confirm('Are you sure you want to delete this form?')){
        $('#rowId'+id).remove();
        $('#remove'+id).remove();
        $('#line'+id).remove();
      }
    }
</script>
<script>
    $(document).ready(function(){
    id1=1;
    $("#add_more").click(function(){
      $("#addstaff").clone().attr('id', 'addstaff'+id1).after("#id").appendTo("#field_wrapper1").find("input[type='text']").val("");
      $addRow1 ='<span id="remove1'+id1+'" class="btn-group" style=" margin-top:-50px; float:right">' 
      +'<span id="remove1" onClick="removeForm1('+id1+')"' 
      +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
      +'<div id="line1'+id1+'"></div>';
      $('#field_wrapper1').append($addRow1);
      id1++;
    }); 

  });
  function removeForm1(id1){  
    if (confirm('Are you sure you want to delete this form?')){
      $('#addstaff'+id1).remove();
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
  function selectStaffArea(this_id)
   {
      var pId = $(this_id).parents("div.addmorerows").attr('id');
       var staff_area_id = this_id.value;
       geHotelDiv(staff_area_id,pId);
   }

   function geHotelDiv(staff_area_id,pId)
   {
      $('#'+pId).find("#hotel_div_id").empty();
      $.ajax({
         url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_hotel_divisions',
                           id: 'id',
                           name: 'hotel_div_name',
                     parent_id: staff_area_id,
               parent_name_id: 'staff_area_id'					 
            },
            success: function (data) {
               $('#'+pId).find("#hotel_div_id").append('<option val="">-Select-</option>');
               $.each(data, function(key, value){
               $('#'+pId).find("#hotel_div_id").append('<option value="'+ key +'">'+ value +'</option>');
               })                     
         }
      });
   }
</script>   
@endsection