@extends('layouts.manager')
@section('page-title', 'Backup Data')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('system/backups/create') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-download"></i> Backup Data</button>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <form action="{{ url('system/backups/delete') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat"><i class="fas fa-trash"></i> Delete All except the latest Backup File</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-secondary">
			<div class="card-header">
                <h3 class="card-title">List of Backups</h3>
            </div>
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Backup Date</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @forelse($files as $file)
                            <tr>
                                <td>{{ $file['backup_date'] }}</td>
                                <td>
                                    {{ $file['file_name'] }}
                                </td>
                                <td>{{ ($file['size']) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('system/backups/download/'.$file['file_name']) }}" class="btn btn-success btn-xs btn-flat margin-r-5"><i class="fa fa-edit"></i> Download</a>
									<a href="#" class="formConfirm btn btn-xs btn-flat btn-danger">
										<i class="fa fa-trash"></i> Delete
										<a data-form="#frmDelete-{{$count}}" data-title="Delete Backup" data-message="Are you sure you want to delete this backup?"></a>
									</a>
                                    <form action="{{ url('system/backups/remove-file/' . $file['file_name']) }}" method="POST" id="{{ 'frmDelete-'.$count }}">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            <?php $count++; ?>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-danger">
                                    <strong>No backup files.</strong>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
			</div>
        </div>
	</div>
</div>
@include('layouts.include.confirm-delete')
@endsection