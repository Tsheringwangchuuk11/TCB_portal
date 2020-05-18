@extends('layouts.manager')
@section('page-title','Technical Clearance Registration')
@section('content')
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title">General Information</h4>
    </div>
    <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
        @csrf
        <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
        <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">CID No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control numeric-only" name="cid_no" value="{{ old('cid_no') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Proposed location for construction.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="location"  value="{{ old('location') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                                <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
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
                                <label for="">Gewog<span class="text-danger"> *</span></label>
                                <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control numeric-only" value="{{ old('contact_no') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" autocomplete="off" >
                            </div>
                        </div>

                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                                    <input type="text" name="tentative_cons" class="form-control" value="{{ old('tentative_cons') }}" autocomplete="off">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="tentative_com" value="{{ old('tentative_com') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control datepicker" name="drawing_date" value="{{ old('drawing_date') }}" id="drawing_date" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">         
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Note:</label>
                                <span>Please kindly submit architectural drawing (soft copy) to <a href="ipdd@tourism.gov.bt">ipdd@tourism.gov.bt</a><span>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
      $('#form_data').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          applicant_name: {
            required: true,
            minlength: 5
          },
          cid_no: {
            required: true,
            maxlength:11
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          applicant_name: {
            required: "Please provide a password",
          },
          cid_no: "Please accept our terms",
          maxlength: "Your cid must be 11 characters long"

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
    
@endsection



