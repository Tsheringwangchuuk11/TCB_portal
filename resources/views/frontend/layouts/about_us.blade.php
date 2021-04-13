@extends('frontend/layouts/template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="invoice p-3 m-4">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                About TCB
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <hr>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                            @if(isset($content->content))  {!! $content->content !!} @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 m-4">
                <div class="card">
                    <div class="card-body">
                        <h6>ABOUT US</h6>
                        <ul>
                            <li> About TCB</li>
                            <li>Tourism Policy</li>
                        </ul>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection
