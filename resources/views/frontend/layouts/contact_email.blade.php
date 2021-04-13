
@extends('layouts.pdf')
@section('title', '')
@section('extra_styles')
<style>
    
    #container {
        padding-top: 20px;
        padding-bottom: 20px;
    }   
</style>
@endsection
@section('content')
    <h4 class="">Hello Admin</h4>
    <div id="container">
        <h4>You received an email from : {{ $name }}<br>
            Here are the details:</h4>  
            <p>Name:<b>{{ $name }}</b></p>    
            <p>Email:<b> {{ $email }}</b></p>     
            <p>Phone Number:<b> {{ $phone_number }}</b></p>   
            <p>Subject:<b> {{ $subject }}</b></p>      
            <p>Message:<b> {{ $user_message }}</b></p>
            <p>Thank You</p>
    </div>
@endsection


