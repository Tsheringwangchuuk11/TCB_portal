
 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>certificate</title>
    </head>
<body style="background-repeat:no-repeat; background-image: url({{ url('/img/certificate/hotel_certificate.jpg') }});"> 
    <div style="margin-top: 515px;" >
        @if ($data->star_category_id==1)
            <p style="text-align:center">
                @for ($i =0 ;  $i<3 ; $i++)
                <img src="{{ public_path('img/certificate/star.jpg') }}" width="18%">
                @endfor
            </p> 
        @elseif($data->star_category_id==2)
            <p style="text-align:center">
                @for ($i =0 ;  $i<4 ; $i++)
                <img src="{{ public_path('img/certificate/star.jpg') }}" width="18%">
                @endfor
            </p> 
        @else
            <p style="text-align:center">
                @for ($i =0 ;  $i<5 ; $i++)
                <img src="{{ public_path('img/certificate/star.jpg') }}" width="20%">
                @endfor
            </p>
        @endif
        <hr style="width:50%;margin-top:-25px;text-align:center;color:orange">
    <div>
    <p style="font-size: 31px; font-family:'Times New Roman', Times, serif;text-align: center;margin-top:0;">
       <b> {{ strtoupper($data->tourist_standard_name)}}</b>
    </p>
    <p style="font-size: 26px; ; font-family:Roboto;text-align: center">
        - {{  strtoupper($data->village_name) }},{{ strtoupper($data->gewog_name )}}, {{ strtoupper($data->dzongkhag_name) }} -
    </p>
    <p style="font-size: 16px; ;text-align: center; font-family:Roboto;margin-top: 175px">
        @foreach (config()->get('settings.director_info') as $k => $v)
            @if ($loop->first)
                {{ $v }}<br>
            @else
                 <b>{{ $v }}</b>
            @endif

        @endforeach
    </p>
    <div>
        <p style="margin-left:350px;font-family:Roboto;font-size: 18px">
            <b>VALID TILL {{ $data->validaty_date }}</b>
        </p>
    </div>
</body>
</html>