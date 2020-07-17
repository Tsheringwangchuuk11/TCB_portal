@extends('frontend/layouts/template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <br>
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-address-book"></i> Contract Address
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <address>
                                Tourism Council of Bhutan<br>
                                Post Box: 126<br>
                                Thimphu, Bhutan<br>
                                Tel: +975 2 323251/323252; <br>
                                Fax: +975 2 323695; <br>
                                Email: info@tourism.gov.bt; <br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <br>
                <form class="form-horizontal">
                    <div class="card-footer">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Contact No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Contact No">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Message</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Content"></textarea>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-success float-right">Send</button>
                    </div>
                </form>
                <br/>
            </div>
        </div>
    </div>
@endsection
