@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tourist Standard Hotels')
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
                <select class="form-control select2bs4" name="application_type" id="application_type" style="width: 100%;">
                    <option value="">- Select -</option>
                    <option value="">New Application</option>
                    <option value="">Renewale</option>
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label>Star Category Type <span class="text-danger">*</span></label>
                <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                    <option value="">- Select -</option>
                    @foreach ($starCategoryLists as $starCategoryList)
                    <option value="{{$starCategoryList->id}}">{{$starCategoryList->star_category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Dispatch Number<span class="text-danger"> *</span><small class="text-danger">[Dispatch number mention in technical clearance letter]</small></label>
                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
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
        <table id="staffDetail" class="table table-condensed table-striped">
            <thead>
                <th class="text-center">#</th>
                <th>CID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Qualification</th>
                <th>Experience</th>
                <th>Salary</th>
                <th>Hospitility relating</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="text" name="" class="form-control input-sm resetKeyForNew" />
                    </td>
                    <td>
                        <input type="radio" name="hospitility" value="Y">Yes
                        <input type="radio" name="hospitility" value="N">No
                    </td>
                </tr>
                <tr class="notremovefornew">
                    <td class="text-right" colspan="9">
                        <a href="#" class="add-table-row btn bg-purple btn-xs"><i class="fa fa-plus"></i> Add New Row</a>
                    </td>
                </tr>
            </tbody>
        </table>
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
    <div class="row">
        <div class="col-md-12">
            <div class="form-group ml-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="terms" id="exampleCheck2">
                    I hereby:
                    <ol>
                        <li>
                            Confirm the accuracy of the provided data; 
                        </li>
                        <li>
                            Agree to submit upon request of the Classification Committee  additional information for classification approval/modification purposes; 
                        </li>
                        <li>
                            Apply for the assignment of ______ star level  and verify the conformity of the accommodation establishment  to the  guideline; 
                        </li>
                        <li>
                            Agree with the terms and conditions laid down in the statutes of the TCB- classification committee and the classification procedure.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
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