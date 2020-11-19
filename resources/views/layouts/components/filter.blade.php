<form action="{{ url()->current() }}" method="GET">
    <div class="row filter">
        {{ $slot }}
        <div class="col-md-2">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-flat" title="Search"><i class="fa fa-search"></i></button>
                <a href="{{ url()->current() }}" class="btn btn-danger btn-flat" title="Clear"><i class="fa fa-undo"></i></a>
            </div>
        </div>
    </div>
</form>