@extends('layouts.app')

@section('content')
<div class="container mt-4">

        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h2>Generated QR Code</h2>
            </div>
            <div class="card-body" style="border: 5px solid;text-align: center;">
                {!! QrCode::size(300)->generate($selectedUser['id']) !!}

                <h5 class="font-medium mb-0">{{$selectedUser['emp_no']}}</h5>
                <h5 class="font-medium mb-0">{{$selectedUser['name']}}</h5>
                <h5 class="font-medium mb-0">{{$selectedUser['department']}}</h5>
                <h5 class="font-medium mb-0">{{$selectedUser['location']}}</h5>
            </div>
        </div>
    </div>
@endsection
