@extends('layouts.manager')
@section('page-title', 'Welcome To Tourism Council Of Bhutan')
@section('content')
<h6><i class="far fa-envelope"></i> Messages / Notification</h6>
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
        <div class="card card-secondary">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-hover table-bordered" id="endUsersTableId">
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Module Name</th>
                            <th>Service Name</th>
                            <th>Submission Date</th>
                            <th>Current Status</th>
                            <th>Approved Date</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                     @if(isset($endUserApplicantDtls))
                     @php
                     @endphp
                        <tbody>
                            @foreach($endUserApplicantDtls as $endUserApplicantDtl)
                                <tr>
                                    <td>
                                        @if ($endUserApplicantDtl->id===9)
                                            @if($endUserApplicantDtl->module_id==1)
                                                <a href="{{ url('verification/tourist-standard-hotel',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                            @elseif($endUserApplicantDtl->module_id==2)
                                                 <a href="{{ url('verification/village-homestay',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                             @elseif($endUserApplicantDtl->module_id==3)
                                                 <a href="{{ url('verification/restaurant',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                            @elseif($endUserApplicantDtl->module_id==4)
                                                 <a href="{{ url('verification/tour-operator',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                             @else
                                             <a href="{{ url('verification/tended-accommodation',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                            @endif
                                        @elseif($endUserApplicantDtl->id===10)
                                             <a href="{{ url('verification/tourist-standard-hotel',['applicationNo'=>$endUserApplicantDtl->application_no,'status'=>$endUserApplicantDtl->id]) }}">{{ $endUserApplicantDtl->application_no }}</a>
                                        @else
                                             {{ $endUserApplicantDtl->application_no }}
                                        @endif
                                       </td>
                                    <td>{{ $endUserApplicantDtl->module_name }}</td>
                                    <td>{{ $endUserApplicantDtl->name }}</td>
                                    <td>{{ $endUserApplicantDtl->created_at }}</td>
                                    <td>
                                        @if ($endUserApplicantDtl->id===1)
                                           <span class="text-info">{{ $endUserApplicantDtl->status_name }}</span>
                                        @elseif($endUserApplicantDtl->id===3) 
                                           <span class="text-success">{{ $endUserApplicantDtl->status_name }}</span>
                                        @elseif($endUserApplicantDtl->id===4)
                                           <span class="text-danger">{{ $endUserApplicantDtl->status_name }}</span>
                                        @else
                                           <span class="text-warning">{{ $endUserApplicantDtl->status_name }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $endUserApplicantDtl->updated_at }}</td>
                                    <td>{{ $endUserApplicantDtl->remarks }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                         <tfoot>
                         </tfoot>
                    @else
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-center text-danger">No data availlable</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#endUsersTableId').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });
    </script>
@endsection
