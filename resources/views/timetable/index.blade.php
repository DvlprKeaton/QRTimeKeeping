@extends('layouts.app')

@section('content')

@if($userrole['role'] == 'Admin')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">User List</a></li>
                <li class="breadcrumb-item">Scanned Attendees</li>
                <li class="breadcrumb-item"><a href="{{route('attendees')}}">Waiting Attendees</a> </li>
              </ol>
          </div>
          <a class="btn btn-warning"
          href="{{ route('export') }}">
              Export User Data
          </a>
            </div>
            </div>
            
            
            <div class="table-responsive">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium">Employee #</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Department</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Location</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Time in</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                    @foreach($users as $u)
                    <tr>
                      <td>
                          <span class="text-muted">{{$u->email}}</span><br>
                          <!--<span class="text-muted">Past : teacher</span>-->
                      </td>
                      <td>

                          <h5 class="font-medium mb-0">{{$u->name}}</h5>
                          <!--<span class="text-muted">Texas, Unitedd states</span>-->
                      </td>
                      <td>
                          <span class="text-muted">{{$u->department}}</span><br>
                          <!--<span class="text-muted">Past : teacher</span>-->
                      </td>
                      <td>
                          <span class="text-muted">{{$u->location}}</span><br>
                          <!--<span class="text-muted">Past : teacher</span>-->
                      </td>

                      <td>
                          <span class="text-muted">{{$u->time_in}}</span><br>
                      </td>
                    </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
            </div>
@endif
        </div>
    </div>
</div>
</div>

@endsection
