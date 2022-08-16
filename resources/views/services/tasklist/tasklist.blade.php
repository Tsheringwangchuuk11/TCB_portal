@extends('layouts.manager')
@section('title', 'Task List')
@section('page-title', 'Task List')
    @section('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><div data-toggle="tooltip" title="This panel lists the applications that are currently in the common task pool">Group Tasks</div></h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible" id="alertGroupId" style="display: none">
                            <i class="fa fa-info-circle fa-lg"></i><strong><span id="spnGroupTaskMsg"></span></strong>
                        </div>
                        <table id="groupTaskId" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Application Number</th>
                                    <th>Module Name</th>
                                    <th>Service Name</th>
                                    <th>Submitted Date</th>
                                    <th>Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupTasklists as $groupTask)
                                    <tr id="grpTaskTR_{{ $groupTask->application_no }}">
                                        <td>
                                            <a href="javascript:void(0)" data-toggle="tooltip" title='{{ $groupTask->application_no }} - Claim' onclick="claimApplication('{{ $groupTask->application_no }}', '{{ $groupTask->service_id }}', '{{ $groupTask->module_id }}')">{{ $groupTask->application_no }}</a>
                                        </td>
                                        <td>
                                            {{$groupTask->module_name}}
                                        </td>
                                        <td>
                                            {{$groupTask->name}}
                                        </td>
                                        <td>
                                            {{$groupTask->created_at}}
                                        </td>
                                        <td>
                                            {{$groupTask->status_name}}
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><div data-toggle="tooltip" title="This panel lists the applications that have been assigned in your name">My Tasks</div></h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible" id="alertMyId" style="display: none">
                            <i class="fa fa-info-circle fa-lg"></i><strong><span id="spnMyTaskMsg"></span></strong>
                        </div>
                        <table class="table table-bordered table-hover" id="myTaskId">
                            <thead>
                                <tr>
                                    <th>Application Number</th>
                                    <th>Module Name</th>
                                    <th>Service Name</th>
                                    <th>Submitted Date</th>
                                    <th>Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myTasklists as $myTask)
                                    <tr id="myTaskTR_{{ $myTask->application_no }}">
                                        <td>
                                            <a href="javascript:void(0)" data-toggle="tooltip" title='{{ $myTask->application_no }} - Unclaim' onclick="unclaimApplication('{{ $myTask->application_no }}', '{{ $myTask->service_id }}', '{{ $myTask->module_id }}')">
                                                <i class="fas fa-hand-point-up">

                                                </i>
                                            </a>
                                            {{--<a href="{{ url('verification/openApplication',['applicationNo'=>$myTask->application_no, 'serviceId'=>$myTask->service_id,'moduleId'=>$myTask->module_id]) }}" data-toggle="tooltip" title="{{ $myTask->application_no }} - Open">--}}
                                            <a href="javascript:void(0)" data-toggle="tooltip" title="{{ $myTask->application_no }} - Open" onclick="openApplication('{{ $myTask->application_no }}', '{{ $myTask->service_id }}', '{{ $myTask->module_id }}')">
                                                {{ $myTask->application_no }}
                                            </a>
                                        </td>
                                        <td>
                                            {{$myTask->module_name}}
                                        </td>
                                        <td>
                                            {{$myTask->name}}
                                        </td>
                                        <td>
                                            {{$myTask->created_at}}
                                        </td>
                                        <td>
                                            {{$myTask->status_name}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#groupTaskId').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });
            $('#myTaskId').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });
        });
        function claimApplication(applicationNo, serviceId, moduleId) {
            $.ajax({
                url:"{{ url('tasklist/claimApplication') }}",
                type:"GET",
                data: {
                    application_no:applicationNo,
                },
                success:function (data) {
                    console.log(data);
                    if(data.status = 'true'){
                        $('#spnGroupTaskMsg').html(data.msg);
                        $('#alertGroupId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        //insert this row in the my task panel
                        $('[data-toggle="tooltip"]').tooltip('hide');
                        var cloneNode = $('#grpTaskTR_'+applicationNo).clone();
                        $(cloneNode).attr('id', 'myTaskTR_'+applicationNo);
                        $(cloneNode).find('td').each(function (i){
                            if (i==0){
                                $(this).find('a').each(function (j) {
                                    $(this).removeAttr('title');
                                    $(this).attr('title', applicationNo+' - Open');
                                    $(this).removeAttr('onclick');
                                    $(this).attr('onClick', 'openApplication(\''+applicationNo+'\', \''+serviceId+'\', \''+moduleId+'\')');


                                })
                            }

                        });
                        var newLink = $('<a></a>');
                        $(newLink).attr('href', 'javascript:void(0)');
                        $(newLink).attr('data-toggle', 'tooltip');
                        $(newLink).attr('title', applicationNo+' - Unclaim');
                        $(newLink).attr('onClick', 'unclaimApplication(\''+applicationNo+'\', \''+serviceId+'\', \''+moduleId+'\')');
                        var newIcon = $('<i></i>');
                        $(newIcon).addClass('fas fa-hand-point-up');
                        $(newLink).append(newIcon);

                        $(cloneNode).find('td:first').prepend(newLink);
                        $('#myTaskId > tbody:last').append(cloneNode);
                        $("#grpTaskTR_"+applicationNo).remove();
                    }else{
                        $('#spnGroupTaskMsg').html(data.msg);
                        $('#alertGroupId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        $("#grpTaskTR_"+applicationNo).remove();
                    }
                }
            });


        }
        function unclaimApplication(applicationNo, serviceId, moduleId){
            $.ajax({
                url:"{{ url('tasklist/releaseApplication') }}",
                type:"GET",
                data: {
                    application_no:applicationNo,
                },
                success:function (data) {
                    if(data.status = 'true'){
                        $('#spnMyTaskMsg').html(data.msg);
                        $('#alertMyId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        //insert this row in the group task panel
                        $('[data-toggle="tooltip"]').tooltip('hide');
                        var cloneNode = $("#myTaskTR_"+applicationNo).clone();
                        $(cloneNode).attr('id','grpTaskTR_'+applicationNo);
                        $(cloneNode).find('td').each(function(i){
                            if(i==0){
                                $(this).find('a').each(function(j){
                                    $(this).removeAttr('title');
                                    $(this).attr('title',applicationNo +' - Claim');
                                    $(this).removeAttr('onclick');
                                    $(this).attr('onClick', 'claimApplication(\''+applicationNo+'\', \''+serviceId+'\', \''+moduleId+'\')');

                                });

                            }
                        });
                        $(cloneNode).find('td:first').find('a:first').remove();
                        $('#groupTaskId > tbody:last').append(cloneNode);
                        $("#myTaskTR_"+applicationNo).remove();
                    }else {
                        $('#spnMyTaskMsg').html(data.msg);
                        $('#alertMyId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        $("#myTaskTR_"+applicationNo).remove();
                    }
                }
            });

        }
        function openApplication(applicationNo, serviceId, moduleId){
            var url = "{{ url('verification/openApplication') }}"+"/"+applicationNo+"/"+serviceId+"/"+moduleId;
            window.location.href = url;
        }

    </script>
@endsection

