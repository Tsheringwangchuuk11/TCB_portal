<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $masterdropdown->master_name }}</h3>
            <div class="card-tools pull-right">
                @if ($privileges["create"] == 1)
                <input type="hidden" name="masterId" id="masterId" value="{{ $masterdropdown->id }}" class="form-control">
                <a href="javascript:void(0)" data-href="{{ url('master/drop-down-master/create') }}"  class="btn  btn-sm btn-success  btn-flat add-dropdown_list"><i class="fa fa-plus" ></i> Add</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Dropdown Name</th>
                        <th>Active Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dropdownlists as $dropdownlist)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{$dropdownlist->dropdown_name}}</td>
                        <td>
                            @if ($dropdownlist->is_active=="Y")
                            Yes 
                            @else
                            No
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($privileges["edit"] == 1)
                               <a href="javascript:void(0)" data-href="{{ url('master/drop-down-master/'. $dropdownlist->id.'/edit') }}"  class="btn  btn-sm btn-info  btn-flat add-dropdown_list" title="Edit">Edit</a>
                            @endif
                            @if((int)$privileges->delete == 1)
                            <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                            <i class="fas fa-trash"></i>
                            <a data-form="#frmDelete-{!! $dropdownlist->id !!}" data-title="Delete {!! $dropdownlist->dropdown_name !!}" data-message="Are you sure you want to delete this room types details ?"></a>
                            </a>
                            <form action="{{ url('master/drop-down-master/' . $dropdownlist->id) }}" method="POST" id="{{ 'frmDelete-'.$dropdownlist->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-danger text-center">No data to be displayed</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            {{-- 
            <div class="float-right">
                {{ $dropdownlists->links() }}
            </div>
            --}}
        </div>
    </div>
</div>
<div class="modal fade" id="dropdown_list_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">{{$masterdropdown->master_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dropdownlist">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.add-dropdown_list').on('click',function(){
            var dataURL = $(this).attr('data-href');
            var masterId = $("#masterId").val();
            $('.dropdownlist').load(dataURL,function(){
                $('#dropdown_list_modal').modal({show:true});
                $('#master_id').val(masterId);
            });
        });
    })
</script>
