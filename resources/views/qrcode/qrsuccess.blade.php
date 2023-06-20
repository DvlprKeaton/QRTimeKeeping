@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

body{
    background-color: #E6EAF5;
    font-family: 'Roboto', sans-serif;
}
.card{
    width: 350px;
    border: none;
    border-radius: 20px;
    background-color: #00AF00;
}
h6{
    color: #E5F3FF;
}
.text{
    color: #FFFFFF;
}
</style>
<div class="container d-flex justify-content-center">
    <div class="card mt-5 p-3">
        <div class="media">
            <div class="media-body" style="text-align:center;">
                <h6 class="mt-2 mb-0">QR Code scanned successfully for {{$uname[0]->name}}</h6>
                <small class="text">QRCode Scanned Successfully</small>
                <a href="{{route('qrscan')}}" class="btn btn-outline-success btn-circle btn-lg btn-circle">Click to scan again</a>
            </div>
        </div>
    </div>
</div>
@endsection
