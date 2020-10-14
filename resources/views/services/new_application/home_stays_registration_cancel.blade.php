@extends('layouts.manager')
@section('page-title','Home Stay Registration Cancellation')
@section('content')
<form action="{{ url('application/save-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Personal  Details</h4>
    </div>
        <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group ">
                                <label for="">CID No.</label>
                                <input type="text" class="form-control" name="cid_no" onchange="getHomeStayDetails(this.value)">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Home Stay Name</label>
                                <input type="text" class="form-control" name="company_title_name" id="company_title_name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="applicant_name" id="name" readonly>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No. </label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="email" readonly>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Dzongkhag</label>
                                <select class="form-control select2bs4 dzongkhagdropdown" name="dzongkhag_id" id="dzongkhag_id" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                    @foreach ($dzongkhagLists as $dzongkhagList)
                                    <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Gewog</label>
                                <input type="text" class="form-control" name="gewog_name" id="gewog_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Chiwog</label>
                                <input type="text" class="form-control" name="chiwog_name" id="chiwog_name" readonly>
                                <input type="hidden" class="form-control" name="chiwog_id" id="chiwog_id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Village </label>
                                <input type="text" class="form-control" name="village_name" id="village_name" readonly>
                                <input type="hidden" class="form-control" name="establishment_village_id" id="village_id">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Thram No. </label>
                                <input type="text" class="form-control" name="thram_no" id="thram_no" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">House No. </label>
                                <input type="text" class="form-control" name="house_no" id="house_no" readonly>
                            </div>
                        </div>
                    </div>
        </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Distance from the nearest town/urban centre (hrs or kms)</label>
                    <input type="text" class="form-control" name="town_distance" id="town_distance" readonly>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Distance from the main road (hrs or kms)</label>
                    <input type="text" class="form-control" name="road_distance" id="road_distance" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Condition of the pathway to house from the road point</label>
                    <input type="text" class="form-control" name="condition" id="condition" readonly>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer text-center" >
        <button type="submit"class="btn btn-success">
            <li class="fas fa-check"></li>
            APPLY
        </button>
        <button type="reset" class="btn btn-danger">
            <li class="fas fa-times"></li>
            RESET
        </button>
    </div>
</div>
</form>
@endsection
@section('scripts')
    <script>
        function getHomeStayDetails(cidNo){
             $.ajax({
                url:'/application/get-homestays-details/'+cidNo,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                dataType: "json",
                success:function(data) {
                        $('#company_title_name').val(data.tourist_standard_name);
                        $('#name').val(data.owner_name);
                        $('#cid_no').val(data.cid_no);
                        $('#contact_no').val(data.contact_no);
                        $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                        $('#gewog_name').val(data.gewog_name);
                        $('#email').val(data.email);
                        $('#chiwog_name').val(data.chiwog_name);
                        $('#chiwog_id').val(data.chiwog_id);
                        $('#village_name').val(data.village_name);
                        $('#village_id').val(data.village_id);
                        $('#thram_no').val(data.thram_no);
                        $('#house_no').val(data.house_no);
                        $('#town_distance').val(data.town_distance);
                        $('#road_distance').val(data.road_distance);
                        $('#condition').val(data.condition);
                        $('#gewog_id').val(data.gewog_id);
                    } 
                }); 
            }
    </script>
@endsection
