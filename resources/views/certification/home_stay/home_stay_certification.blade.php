
 <!DOCTYPE html>
 <html>
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>certificate</title>
     </head>
 <body style="background-repeat:no-repeat; background-image: url({{asset('img/certificate/home_stay_certificate.jpg') }});"> 
    <div style="margin-top: 293px;" >
        <p style="margin-left: 130px;">test</p>
    <div>
     <p style="font-size: 16px; ;text-align: center; font-family:Roboto;margin-bottom: 0">
         @foreach (config()->get('settings.director_info') as $k => $v)
             @if ($loop->first)
                 {{ $v }}<br>
             @else
                  <b>{{ $v }}</b>
             @endif
         @endforeach
     </p>
 </body>
 </html>