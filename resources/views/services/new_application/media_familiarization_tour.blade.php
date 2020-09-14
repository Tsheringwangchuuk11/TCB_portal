@extends('layouts.manager')
@section('page-title','Bhutan Media Familarization')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="applicant_name" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">CID <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Designation <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="designation" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger"> *<span></label>
                        <input type="text" class="form-control" name="email" autocomplete="off" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Website<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="webpage_url" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Agency Name <span class="text-danger"> *</span></label>
                        <input type="text" name="company_title_name" class="form-control" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Agency Address <span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">City <span class="text-danger"> *<span></label>
                        <input type="text" class="form-control" name="city" autocomplete="off" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Country <span class="text-danger"> *</span></label>
                        <select  name="country_id" class="form-control select2bs4" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for=""> From Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                        <input type="date" class="form-control" name="from_date" id="from_date" autocomplete="off" placeholder="Select Date"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">To Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                        <input type="date" class="form-control datepicker" name="to_date" id="to_date" autocomplete="off" placeholder="Select Date">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Agency Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" >
                    <table  class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Channel</th>
                                <th>Name </th>
                                <th>Circulation</th>
                                <th>Target Audience</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($channelTypes as $channelType)
                            <tr>
                                <td>{{ $channelType->channel_type}}</td>
                                <td>
                                    <input type='hidden' name='channel_type_id[]'value="{{ $channelType->id }}" class='form-control'>
                                    <input type='text' name='channel_name[]' class='form-control'>
                                </td>
                                <td><input type='text' name='circulation[]' class='form-control'></td>
                                <td><input type='text' name='target_audience[]' class='form-control'></td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bhutan Coverage & Distribution Channel</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Mention all area/topic of Bhutan coverage<span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-2">
                    <label>Channel Name<span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Channel Link <span class="text-danger">*</span> </label>
                </div>
                <div class="form-group col-md-2">
                    <label>Channel Type<span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-2">
                    <label>Intended Date of Feature<span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="row addmorerows" id="addstaff">
                <div class="form-group col-md-3">
                    <input  type="text" id="c_coverage" class="form-control" name="area_coverage[]" autocomplete="off"/>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" id="c_name" class="form-control" name="channel[]" autocomplete="off">             
                </div>
                <div class="form-group col-md-2">
                    <input  type="text" id="c_link" class="form-control" name="channel_link[]" autocomplete="off"/>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="channel_type[]" id="room_type_id">
                        <option value=""> - Select - </option>
                        {{-- @foreach ($channelTypes as $channelType)
                        <option value="{{ $channelType->id }}">{{ $channelType->channel_type }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input  type="date" id="c_date" class="form-control" name="intended_date[]" autocomplete="off">
                </div>
            </div>
            <div id="field_wrapper1"></div>
            <span class="btn btn-success btn-sm float-right" id="add_more"> <i class="fas fa-plus fa-sm">Add</i> </span>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <strong> Required supporting documents:</strong>
            <ol>
                <li>
                    <em>Address your application to the Director, Tourism Council of Bhutan (In English)</em>      
                </li>
                <li>
                    <em>Recommendation letter from the head of the agency (In English)
                    </em><br>  
                    a.Include designation/role of your staff visiting Bhutan 
                </li>
                <li>
                    <em>Route your application through a registered Bhutanese tour operator </em>      
                </li>
                <li>
                    <em>All members of the approved media FAM tour must meet relevant officials from the Tourism Council of Bhutan, preferably towards the end of your Bhutan trip</em>      
                </li>
                <li>
                    <em>After your Bhutan visit you must submit copy/copies of your coverage to the Tourism Council of Bhutan. You can email Bhutan coverage to <a href="info@tourism.gov.bt">info@tourism.gov.bt</a><em>      
                </li>
                <li>
                    <em>You hereby agree to give permission to the Tourism Council of Bhutan to use the coverage(s) (print, online and TV) on Bhutan to promote Bhutan. TCB and its partners will only use for promotion of Bhutan only.<em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success btn-sm">
                <li class="fas fa-check"></li>
                APPLY
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
                <li class="fas fa-times"></li>
                RESET
            </button>
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
    </script>
@endsection





