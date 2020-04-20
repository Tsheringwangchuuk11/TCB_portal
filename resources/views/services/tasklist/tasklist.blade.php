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
                                <tr id="grpTaskTR_004_0021828">
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title='004_0021828 - Claim' onclick="claimApplication('004_0021828')">10902002285</a>
                                    </td>
                                    <td>
                                        Hotel Name
                                    </td>
                                    <td>
                                        Apply
                                    </td>
                                    <td>
                                        16/04/2020
                                    </td>
                                    <td>
                                        Submitted
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><div data-toggle="tooltip" title="This panel lists the applications that have been assigned in your name">My Tasks</div></h3>
                    </div>
                    <div class="card-body">
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
                            <tr id="myTaskTR_0021828">
                                <td>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title='0021828 - Unclaim' onclick="unclaimApplication('0021828')">
                                        <i class="fas fa-hand-point-up">

                                        </i>
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="0021828 - Open" onclick="openApplication('0021828')">
                                        10902002285
                                    </a>
                                </td>
                                <td>
                                    Hotel Name
                                </td>
                                <td>
                                    Apply
                                </td>
                                <td>
                                    16/04/2020
                                </td>
                                <td>
                                    Submitted
                                </td>
                            </tr>
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
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#myTaskId').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
        function claimApplication(applicationNo) {
            $.ajax({
                url:"{{ url('tasklist/claimApplication') }}",
                type:"GET",
                data: {
                    id:'hi',
                },
                success:function (data) {
                    alert(data);
                }
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
                        $(this).attr('onClick', 'openApplication('+applicationNo+')')


                    })
                }

            });
            var newLink = $('<a></a>');
            $(newLink).attr('href', 'javascript:void(0)');
            $(newLink).attr('data-toggle', 'tooltip');
            $(newLink).attr('title', applicationNo+' - Unclaim');
            $(newLink).attr('onClick', 'unclaimApplication(\''+applicationNo+'\')');
            var newIcon = $('<i></i>');
            $(newIcon).addClass('fas fa-hand-point-up');
            $(newLink).append(newIcon);

            $(cloneNode).find('td:first').prepend(newLink);
            $('#myTaskId > tbody:last').append(cloneNode);
            $("#grpTaskTR_"+applicationNo).remove();

        }
        function unclaimApplication(applicationNo){
            $.ajax({
                url:"{{ url('tasklist/releaseApplication') }}",
                type:"GET",
                data: {
                    id:'hi',
                },
                success:function (data) {
                    alert(data);
                }
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
                        $(this).attr('onClick', 'claimApplication(\''+applicationNo+'\')');

                    });

                }
            });
            $(cloneNode).find('td:first').find('a:first').remove();
            $('#groupTaskId > tbody:last').append(cloneNode);
            $("#myTaskTR_"+applicationNo).remove();
        }
        function openApplication(applicationNo){
            $.ajax({
                url:"{{ url('tasklist/openApplication') }}",
                type:"GET",
                data: {
                    id:'hi',
                },
                success:function (data) {
                    alert(data);
                }
            });

        }
    </script>
@endsection

