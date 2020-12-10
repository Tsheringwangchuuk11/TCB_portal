
 <!DOCTYPE html>
 <html>
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>certificate</title>
     </head>
 <body style="background-repeat:no-repeat; background-image: url({{ url('//img/certificate/home_stay_certificate.jpg') }});"> 
    <div style="margin-top: 293px;" >
        <p style="margin-left: 60px;">Reg. No.:<b>{{$dispatchNo}}</b><span style="margin-left: 40px;">Valid till:<b>{{$data->validaty_date}}</b></span></p>
    </div>
    <div style="margin-top: 50px">
        <p style="text-align:center">- This is to certify that - </p>
    </div>
    <div>
        <p style="text-align:center"><b>{{ strtoupper($data->tourist_standard_name) }}</b></p>
        <p style="text-align:center"><b>VILLAGE HOME STAY</b></p>
    </div>
    <div>
        <p style="text-align:center">is registered with the Tourism Council of Bhutan
        </p>
        <hr style="width:50%;text-align:center;color:green">
    </div>
    <div style="margin-top: 150px">
        <p style="margin-left: 80px;">
            <span>Name:<b>{{$data->owner_name}}</b></span> <span style="margin-left: 170px;">CID#<b>{{$data->cid_no}}</b></span>
        </p>
        <p style="margin-left: 80px;margin-top: 10px;">
            <span>Dzongkhag:<b>{{$data->dzongkhag_name}}</b></span><span style="margin-left: 100px;">Gewog:<b>{{$data->village_name}},{{$data->gewog_name}}</b></span>
        </p>
    </div>
    <div style="margin-top: 150px">
     <p style="font-size: 16px; ;text-align: center; font-family:Roboto;margin-bottom: 0">
         @foreach (config()->get('settings.director_info') as $k => $v)
             @if ($loop->first)
                 {{ $v }}<br>
             @else
                  <b>{{ $v }}</b>
             @endif
         @endforeach
     </p>
    </div>
 </body>
 </html>