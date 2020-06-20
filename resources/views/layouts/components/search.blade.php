    <form  class="form-inline ml-3 float-right" action="{{ url()->current() }}" method="GET">
            {{ $slot }}
            <div class="input-group-append">
                <button class="btn btn-info btn-flat" type="submit"><i class="fas fa-search"></i> </button>
            </div>
            <a href="{{ url()->current() }}" class="btn btn-danger" title="Clear"><i class="fa fa-undo"></i></a>
    </form>
