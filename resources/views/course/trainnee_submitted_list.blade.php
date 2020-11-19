@extends('layouts.manager')
@section('title', 'Trainee')
@section('page-title',$coursetitle->dropdown_name)
@section('content')
    <style>
        .dataTables_wrapper {
            font-size: 14px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selected Trainee List
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover datatableId" id="datatableId1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Application No.</th>
                                <th>Citizen ID No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedTraineeLists as $selectedTraineeList)
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td> {{$selectedTraineeList->application_no}}</td>
                                <td> {{$selectedTraineeList->applicant_cid_no}}</td>
                                <td> {{$selectedTraineeList->applicant_name}}</td>  
                                <td> {{$selectedTraineeList->applicant_email}}</td>  
                                <td> {{$selectedTraineeList->applicant_contact_no}}</td>  
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ url('course/view-submitted-trainee-dtls',['application_no'=>$selectedTraineeList->application_no,'status'=>'Selected']) }}" class="openPopup btn bg-green btn-xs btn-flat"><i class="fas fa-edit"></i> Edit</a> 
                                </td>  
                            </tr> 
                            @endforeach
                        </tbody>
                     </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Trainee List
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover datatableId" id="datatableId">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Application No.</th>
                                <th>Citizen ID No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registeredTraineeLists as $registeredTraineeList)
                            <tr>
                                <td> {{$loop->iteration}}</td>
                                <td> {{$registeredTraineeList->application_no}}</td>
                                <td> {{$registeredTraineeList->applicant_cid_no}}</td>
                                <td> {{$registeredTraineeList->applicant_name}}</td>  
                                <td> {{$registeredTraineeList->applicant_email}}</td>  
                                <td> {{$registeredTraineeList->applicant_contact_no}}</td>  
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ url('course/view-submitted-trainee-dtls',['application_no'=>$registeredTraineeList->application_no,'status'=>'Not Selected']) }}" class="openPopup btn bg-blue btn-xs btn-flat"><i class="fas fa-eye"></i> View</a> 
                                    <a href="{{ url('course/selected-status-update', ['application_no'=>$registeredTraineeList->application_no,'course_dtl_id'=>$registeredTraineeList->course_dtl_id]) }}" class="btn bg-purple btn-xs btn-flat" title="Select"><i class="fas fa-edit"></i> Select</a>
                                </td>  
                            </tr> 
                            @endforeach
                        </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content traineelist">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.datatableId').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });

        });
        $(document).ready(function(){
            $('.openPopup').on('click',function(){
                var dataURL = $(this).attr('data-href');
                $('.traineelist').load(dataURL,function(){
                    $('#modalbox').modal({show:true});
                });
            }); 
        });
    </script>
@endsection