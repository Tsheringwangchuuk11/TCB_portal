@extends('layouts.manager')
@section('page-title','Ownership/Name change/Cancellation ofT CB Certified Tourist Hotels')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Information</h4>
        </div>
        <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
        <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
        <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
        <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Application Type</label>
                    <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{$applicationType->id}}">{{$applicationType->dropdown_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <h5 id="oldowner" style="display: none">Previous Owner Information</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">License Number <span class="text-danger"> *</span> </label>
                    <input type="text" class="form-control" name="license_no" onchange="getOwnerChangeDetails(this.value)">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label>Star Category Type</label>
                    <input type="text" class="form-control" name="star_category_id" id="star_category_id" readonly="true">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">License Date </label>
                    <input type="date" class="form-control" name="license_date" id="license_date" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Hotel Name </label>
                    <input type="text" class="form-control" name="company_title_name" id="company_title_name" readonly="true">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name</label>
                    <input type="text" class="form-control" name="old_owner" id="old_owner" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No. </label>
                    <input type="text" class="form-control" name="old_cid_no" id="old_cid_no" readonly="true">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Address </label>
                    <input type="text" class="form-control" name="old_address" id="old_address" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Contact No. </label>
                    <input type="text" class="form-control" name="old_contact_no" id="old_contact_no" readonly="true">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5 ">
                    <label for="">Fax </label>
                    <input type="text" class="form-control" name="fax" id="fax" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Email </label>
                    <input type="email" class="form-control" name="old_email" id="old_email" readonly="true">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Internet Homepage </label>
                    <input type="text" class="form-control" name="webpage_url" id="webpage_url" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Beds </label>
                    <input type="number" class="form-control" name="number" id="number" readonly="true">
                </div>
            </div>
            <div id="name_change_info" style="display: none">
                <h5>Name Change</h5>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">New Name <span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="company_title_name">
                    </div>
                </div>
            </div>
            <div id="newowner" style="display:none">
                <h5>New Owner Information</h5>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Owner Name <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="owner_name">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">CID No. <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="contact_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email <span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">Hotel location</h4>
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
                    <input type="text" class="form-control" name="gewog_name" id="gewog_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="village_id" id="village_id">
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol id="ownership_change" style="display:none">
                <li>
                    <em>
                    Aggreement letter between Old owner and new owner with legal stamp</em> 
                </li>
                <li>  
                    <em>CID copy</em>
                </li>
                <li>  
                    <em>Business license</em>
                </li>
                <li>  
                    <em>Tax clearance </em>
                </li>
            </ol>
            <ol id="name_change" style="display:none">
                <li></li>
            </ol>
            <ol id="cancelllation" style="display:none">
                <li></li>
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
        function getOwnerChangeDetails(licenseNo){
            $.ajax({
                url:'/application/get-hotel-details/'+licenseNo,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                dataType: "json",
                success:function(data) {
                    console.log(data);
                        $('#star_category_id').val(data.star_category_name);
                        $('#license_date').val(data.license_date);
                        $('#company_title_name').val(data.tourist_standard_name);
                        $('#old_owner').val(data.owner_name);
                        $('#old_cid_no').val(data.cid_no);
                        $('#old_contact_no').val(data.contact_no);
                        $('#old_address').val(data.address);
                        $('#fax').val(data.fax);
                        $('#old_email').val(data.email);
                        $('#webpage_url').val(data.webpage_url);
                        $('#number').val(data.bed_no);
                        $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                        $('#gewog_name').val(data.gewog_name);
                        $('#village_name').val(data.village_name);
                    } 
                });
            }
        $(document).ready(function(){
            $('#application_type').on('change',function(e) {
                var application_type=e.target.value;
                if(application_type == "1"){
                    $("#newowner").show();
                    $("#oldowner").show();
                    $("#ownership_change").show();
                    $("#name_change").hide();
                    $("#cancelllation").hide();
                    $("#name_change_info").hide();
                } 
                else if(application_type == "2"){
                    $("#newowner").hide();
                    $("#oldowner").hide();
                    $("#ownership_change").hide();
                    $("#name_change").show();
                    $("#name_change_info").show();
                    $("#cancelllation").hide();
                } 
                else if(application_type == "3"){
                    $("#newowner").hide();
                    $("#oldowner").hide();
                    $("#ownership_change").hide();
                    $("#name_change").hide();
                    $("#cancelllation").show();
                    $("#name_change_info").hide();
                }
            });
        });
    </script>
@endsection
