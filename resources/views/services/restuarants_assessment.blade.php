@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tourist Standard Restaurants')
@section('content') 
<form action="{{ url('application/save-application') }}" method="POST" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">General Information</h3>
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
        </div>
    </div>
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">Restuarant Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value=""> -Select-</option>
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

        function geHotelDiv(staff_area_id,pId){
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
