@extends('public_view.main')
@section('page-title','Application')
@section('content')
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    New Application
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Modules</label>
                                <select name="modules" id="modules_id" class="form-control" onchange="loadServices(this.value);">
                                    <option value="">- Select Service Module -</option>
                                    @foreach ($servicemodule as $servicemodule)
                                    <option value="{{ $servicemodule->module_id }}"> {{ $servicemodule->module_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7 offset-md-1">
                            <div class="form-group">
                                <label for="">Services</label>
                                <span id="list_id"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>  
@endsection