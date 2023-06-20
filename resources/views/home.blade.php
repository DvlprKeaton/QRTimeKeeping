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
                <li class="breadcrumb-item">User List</li>
                <li class="breadcrumb-item"><a href="{{route('timetable')}}">Scanned Attendees</a> </li>
                <li class="breadcrumb-item"><a href="{{route('attendees')}}">Waiting Attendees</a> </li>
              </ol>
          </div>
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
                      <th scope="col" class="border-0 text-uppercase font-medium">QRCODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                    @foreach($users->sortBy('id') as $u)
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
                    <form action="{{route('qrcode')}}" method="POST">
                        @csrf
                        <input type="text" name="id" id="id" value="{{$u->id}}" hidden>
                        <input type="submit" value="Generate QR" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                    </form>
                      </td>
                    </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
</div>
@elseif($userrole['role'] == 'Scanner')
    <script>
        window.location.href = "{{ route('qrscan')}}";
    </script>
@elseif($userrole['role'] == 'Employee')
    <script>
        window.location.href = "{{ route('qrpersonal')}}";
    </script>
    
@endif
@endsection
