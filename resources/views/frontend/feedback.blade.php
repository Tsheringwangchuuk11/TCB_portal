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
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Contact No</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Contact No">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Content"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Send</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
