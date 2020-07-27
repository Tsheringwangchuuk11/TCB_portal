@extends('layouts.manager')
@section('page-title', 'Welcome To Tourism Council Of Bhutan')
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
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });
            jQuery('#container').highcharts(
            {!! json_encode($chartArray)!!}
            )
        });
   
</script>
@endsection

