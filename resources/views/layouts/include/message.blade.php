@if($errors->count() > 0)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-ban"></i>
            Error(s) have occurred. You need to correct them and try again.<br>
            @foreach($errors->all(':message<br>') as $error)
                {!! $error !!}
            @endforeach
        </div>
    </div>
</div>
@endif
@if(Session::has('msg_error'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-ban"></i>
            {{ Session::get('msg_error') }}
        </div>
    </div>
</div>
@endif
@if(Session::has('msg_success'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check"></i>
            {{ Session::get('msg_success') }}
        </div>
    </div>
</div>
@endif
@if(Session::has('msg_info'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-info"></i>
            {{ Session::get('msg_info') }}
        </div>
    </div>
</div>
@endif
@if(Session::has('appl_info'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check"></i>
            {{ Session::get('appl_info') }}
        </div>
    </div>
</div>
@endif
