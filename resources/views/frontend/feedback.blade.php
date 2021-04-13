@extends('frontend/layouts/template')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Feedback Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ url('contact-post') }}">
                    @csrf
                    <div class="card-footer">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="subject" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="sender_email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Contact No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_no" placeholder="Contact No">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Message</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" name="content" placeholder="Content"></textarea>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-success float-right">Send</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
