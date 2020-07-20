@extends('layouts.manager')
@section('page-title', 'Welcome To Tourism Counsil Of Bhutan')
@section('content')
<div class="row">
    <div class="col-md-12">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        jQuery(function() {
            jQuery('#container').highcharts(
            {!! json_encode($chartArray)!!}
            )
        });
   
</script>
@endsection

