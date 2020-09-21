@extends('layouts.manager')
@section('page-title', 'Master')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dropdown Master</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Master Name</label>
                        <select class="form-control" name="master_name" id="master_name" style="width: 100%;" onchange="getmasterdropdownlist()">
                            @foreach ($masterDropDownLists as $masterDropDownList)
                            <option value="{{$masterDropDownList->id}}">{{$masterDropDownList->master_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="dataResult">
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        getmasterdropdownlist();
    })
    function getmasterdropdownlist() {
     var masterId=$("#master_name").val();
     $('#dataResult').load('{{url("master/drop-down-master/")}}/'+masterId);
    }
</script>
@endsection
