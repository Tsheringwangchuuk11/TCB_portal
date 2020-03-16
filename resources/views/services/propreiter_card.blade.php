@extends('public_view.main')
@section('page-title','New : Propreiter Card')
@section('content')
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title"> Propertetor Card Form </h4>
    </div>
    <form action="{{ url('new-license/store') }}" method="POST" enctype="multipart/form-data">
     @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Company Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="company_name" id="designation" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Trade License No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="license_no" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="">Phone No.<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control required" name="phone_no" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">validity<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="validity" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="">Office Location<span class="text-danger"> *</span></label>
                                <input type="text" name="office_location" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <h5>File Attachment<span class="text-danger"> *</span></h5>
                    <strong>Required supporting documents:</strong>
                            <ol>
                                <li>
                                    <em>Valid Trade License </em>      
                                </li>
                                <li>
                                    <em>Valid NOC</em>
                                </li>
                                <li>
                                    <em>BIT clearance </em>      
                                </li>
                                <li>
                                    <em>CID copy </em>      
                                </li>
                            </ol>
                            <span class="btn btn-success btn-sm fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>Add files...</span>
                                <input id="fileupload" type="file" name="files[]" multiple="">
                            </span>
                    </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success btn-sm"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger btn-sm"><li class="fas fa-times"></li> RESET</button>
        </div>
    </form>
</div>          
@endsection







