@extends('layouts.pdf')
@section('title', 'Recommendation Letter')
@section('extra_styles')
<style>
    #container {
        height: auto;
        width: 100%
    }   
</style>
@section('content')
<div id="container">
    <img src="{{ URL::to('img/tcblogo/letter_header.png') }}" width="100%" height="100%"/>
    <hr>
    <div class="row col-md-12">
        <h6 class="float-left">{{ $dispatch_no }}</h6>
        <h6 class="float-right">Date:{{ date('m/d/yy', strtotime(now())) }}</h6>
    </div><br><br>
    <div class="row col-md-12">
        <p>{!! $content->to_address !!}</p>
    </div><br><br>
    <div class="row col-md-12">
        <p>Sub:<strong>{{ $content->subject }}</strong></p>
    </div><br>
    <div class="row col-md-12">
        <p>Dear:{{ $content->salutation }},</p>
    </div><br>
    <div class="row col-md-12">
        <p class="justify-content">{!! $body[0] !!}</p>
    </div><br><br>

    <div class="row col-md-12">
        <p>{{ $content->closing }}</p>
    </div>
    <div class="row col-md-12">
        <p>
            <img src="{{ URL::to($content->signature_path) }}" width="100px" height="50px"/><br>
            {!! $content->subscription !!}
        </p>
    </div><br>
    <div id="footer">
        <p class="text-center">
            <small>
                Tourism Council of Bhutan, Tarayana Center, P.O.Box 126, GPO Thimphu, Bhutan<br>
                Tel: +975 2 323251 / 323252 /230 Fax: +975 2 323695  info@tourism.gov.bt<br>
                www.tourism.gov.bt | www.bhutan.travel | facebook.com/destinationbhutan | twitter.com/tourismbhutan<br>
            </small>
        </p>
    </div>
</div>
 @endsection