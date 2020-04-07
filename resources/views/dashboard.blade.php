@extends('layouts.manager')
@section('page-title', 'Welcome Tourism Counsel Of Bhutan')
@section('content')
<h6><i class="far fa-envelope"></i> Messages / Notices</h6>
<div class="row">
    <div class="col-md-12">
        <div class="small-box info-box">
            <div class="inner">
                <h6><u><b>Gentle Reminder</b></u></h6>
                <p class="text-justify">One of the key evaluation criteria is how funding a particular Festival/Event may enhance tourism product and infrastructure development. Please indicate how your Festival/Event would contribute towards diversification of tourism product and ensuring long-term health and stability of tourism revenue generation and, especially, how it might result in future tourism activity vibrancy in the locality, leading to community benefit/ or enhanced tourism revenue generation. Quantify your projections and indicate how you propose to verify your results</p>
                <ol>
                    <li>Click on new applicatin in side bar</li>
                    <li>It will display modules</li>
                    <li>Select the module</li>
                    <li>Choose the service</li>
                    <li>Fill up and click appy button</li>
                </ol>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<h6><i class="fas fa-arrow-circle-right"></i> Lastest Applications</h6>
<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <td>Application ID</td>
                            <td>Service Name</td>
                            <td>Submission Date</td>
                            <td>Status</td>
                            <td>Approved Date</td>
                            <td>Reason</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center text-danger">No data availlable</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection