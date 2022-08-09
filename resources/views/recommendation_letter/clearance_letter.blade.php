<!DOCTYPE html>
<html>
<head>
    <style>
        #wrapper {
            height: auto;
            width: 100%;
            position: relative;
        }  
        #container {
            height: auto;
            width: 100%;
            margin-left:5%;
            margin-right:5%;
        } 
        #footer {
                position: absolute;
                bottom: 0;
                left: 0;
                }  
    </style>
</head>
<body>
<div id="wrapper">
    <img src="{{ public_path('img/tcblogo/letter_header.png') }}" width="100%">	
    <div id="container">
        <hr style="color: #312e70;height: 0;">
        <div style="margin-top: 20px">
            <p style="">{{ $dispatch_no }}<strong style="float:right">{{ date('jS M, Y', strtotime(now())) }}</strong></p>
        </div>
        <div>
            <p>{!! $to_address !!}</p>
        </div>
        <div>
            <p>Sub:<strong style="border-bottom: 2px solid ">{{ $content->subject }}</strong></p>
        </div>
        <div>
            <p>Dear {{ $content->salutation }},</p>
        </div>
        <div>
            <p>{!! $body[0] !!}</p>
        </div>

        <div>
            <p>{{ $content->closing }}</p>
        </div>
        <div>
            <p>
  		<img src="{{ public_path($content->signature_path) }}" width="100px" height="50px"/> 
                <br>
                {!! $content->subscription !!}
            </p>
        </div>
        <div>
            <p>{{ $content->cc }}</p>
        </div>
    </div>
    <div id="footer">
        <hr style="margin-left:10%;margin-right:10%;color:green">
        <hr style="margin-left:5%;margin-right:5%;margin-bottom:0;color: #312e70;">
        <p style="text-align:center;margin-top:0">
                Tourism Council of Bhutan, Tarayana Center, P.O.Box 126, GPO Thimphu, Bhutan <br> 
                Tel: +975 2 323251 / 323252 /230 Fax: +975 2 323695  info@tourism.gov.bt<br>
                www.tourism.gov.bt | www.bhutan.travel | facebook.com/destinationbhutan | twitter.com/tourismbhutan
        </p>
    </div>
</div>
</body>
</html>
