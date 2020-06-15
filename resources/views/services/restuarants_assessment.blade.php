@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Assessment')
@section('content') 
@php use App\Http\Controllers\Application\ServiceController; @endphp
<form action="{{ url('application/save-application') }}" method="POST" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header bg-success">
        <h3 class="card-title">Registration of Tourist Standard Restuarant</h3>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">License Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="license_no" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">License Date <span class="text-danger">*</span> </label>
                        <input type="date" class="form-control" name="license_date" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Restaurant Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="company_title_name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control numeric-only" name="cid_no" autocomplete="off">
                    <span class="text-danger">{{ $errors->first('cid_no') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Owner <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="owner_name" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contact No <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control numeric-only" name="contact_no" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Fax <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="fax" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="email" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="webpage_url" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
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
                <em>Please attach additional sheets where necessary like pictures of the office</em>   
           </li>
        </ol>  
        @include('services/fileupload/fileupload')
                </div>
        <!-- card body ends -->
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>    
        </div>

</form>
@endsection
@section('scripts')
<!-- staff -->
<script>
    $(document).ready(function () {
    $('.select2bs4').on('change', function () {
        $(this).valid();
        });
    });
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
$(document).ready(function () {
function loadChecklistDetails() {
    var url="{{ url('application/get-restaurantchapters') }}";
		var options = {target:'#showdivid',
        url:url,
        type:'POST',
        data: $("#formdata").serialize()};
        $("#formdata").ajaxSubmit(options);
  }
window.onload=loadChecklistDetails();
});
</script>
@endsection
