@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Assessment')
@section('content') 
@php use App\Http\Controllers\Application\ServiceController; @endphp
<div class="card">
    <div class="card-header bg-success">
        <h3 class="card-title">Registration of Tourist Standard Restuarant</h3>
    </div>
    <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
        <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
        <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
        <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
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
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="name" autocomplete="off">
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
                        <input type="text" class="form-control" name="owner" autocomplete="off" required>
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
                        <input type="text" class="form-control" name="internet_url" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Location <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="location_id" style="width: 100%;">
                            <option value="">-Select-</option>
                        </select>
                    </div>
                </div>
            </div>

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
            <div class="row" id="row1">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="staff_area_id[]" required>
                            <option value="">-Select-</option>
                            @foreach ($staffAreaLists as $staffAreaList)
                                <option value="{{ $staffAreaList->id }}"> {{ $staffAreaList->staff_area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="hotel_div_id[]" required>
                            <option value="">-Select-</option>
                             @foreach ($hotelDivisionLists as $hotelDivisionList)
                                <option value="{{ $hotelDivisionList->id }}"> {{ $hotelDivisionList->hotel_div_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="staff_name[]" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="staff_gender[]" required>
                            <option value="">-Select-</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="field_wrapper1"></div>
            <span class="btn btn-success btn-sm float-right" id="add1"> <i class="fas fa-plus fa-sm"> Add</i> </span>
            <h5>Inspector’s Checklist</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Inspectors Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="inspector_name" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Inspection Date <span class="text-danger">*</span> </label>
                        <input type="date" class="form-control" name="inspector_date" autocomplete="off">
                    </div>
                </div>
            </div>
        <h5>File Attachment<span class="text-danger"> *</span></h5>
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>Please attach additional sheets where necessary like pictures of the office</em>   
           </li>
        </ol>  
        @include('services/fileupload/fileupload')
        </div> <!-- card body ends -->
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>    
    </form>
</div>
@endsection
@section('scripts')
<!-- staff -->
<script>
    $(document).ready(function(){
        id=1;
        $("#add1").click(function(){
            $("#row1").clone().attr('id', 'row1'+id).after("#id").appendTo("#field_wrapper1");
            $addRow ='<div id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
            +'<span id="remove" onClick="removeForm1('+id+')"' 
            +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></div>'
            +'<div id="line'+id+'"></div>';
            $('#field_wrapper1').append($addRow);
            id++;
        });
    });

    function removeForm1(id){  
        if (confirm('Are you sure you want to delete this form?')){
            $('#row1'+id).remove();
            $('#remove'+id).remove();
            $('#line'+id).remove();
        }
    }
</script>
@endsection
