@extends('layouts.manager')
@section('page-title','EOI')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Proponent Details</h4>
        </div>
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
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Address<span class="text-danger"> *</span></label>
                                <textarea type="text" name="address" class="form-control" row="3" value="{{ old('nationality') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Product Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Product Type<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="product_type" value="{{ old('product_type') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Location<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="location" value="{{ old('location') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Implementing modality<span class="text-danger"> *</span></label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Product Summary<span class="text-danger"> *</span></label>
                                <textarea type="text" name="address" class="form-control" row="3" value="{{ old('nationality') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> Activities and/or results framework<span class="text-danger"> *</span></label>
                                <textarea type="text" name="address" class="form-control" row="3" value="{{ old('nationality') }}"></textarea>
                            </div>
                        </div>
                        
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
            <ol>
                <li>
                    <em>An application addressed to the Director General of TCB requesting the issuance
                    of technical clearance.</em>   
                    </em>
                </li>
                <li>
                    <em>
                    Architectural drawings 
                    </em>
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
</script>
@endsection



