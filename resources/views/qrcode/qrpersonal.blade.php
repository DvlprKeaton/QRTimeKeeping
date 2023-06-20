@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="card">
            

            <div class="media-body" style="text-align:center;">

                @if(count($checkAttendees) == 0)
                <h2 >{{ Auth::user()->name }} of {{ Auth::user()->department }}</h2>
                <div class="card-header" style="background-image:url({{url('img/header2.jpg')}}); background-repeat: no-repeat;
  background-size: 100% 100%;
}">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
                </div>
                <div style=" background-repeat: no-repeat;
  background-size: 100% 100%;text-align: left;padding-left: 50px;background-image:url({{url('img/body.jpg')}})">
                <h6 style="color: white;text-align: left;">Please confirm if you are going to attend</h6>
                <form action="{{ route('qrattend')}}" method="POST">
                    @csrf
                <div style="color:white;">
                    Registration Reminders
<hr> 
●   All employees attending the event must register and get their QR code. Please screenshot or take a picture of your QR code and bring to the event. 
<br>
●   At the event, please look for the QR code scanning area at the entrance to have your QR code scanned. 
<br>
●   Since we will be using the full employee list for the raffle, those who did not attend the event OR arrived past the registration time of 6:30pm shall have their raffle prizes forfeited. 
<br>
●   Arrival time shall be monitored via the QR scanned upon entering the venue. Kindly take a picture of the scanning for validation in case there may be a need after the event.
<br> 
●   For raffle prizes, employees must claim the item on the given claiming period.
<br>
●   All forfeited prizes shall be donated to charitable organizations. 
<br>
<hr> 
Additional Reminders
<hr> 
●   EARLY OUT (3:00 pm) in the office is only applicable for employees who will attend the thanksgiving party. For those who will not attend, they are required to finish the working hours that day. Otherwise, undertime policies shall apply.
<br> 
●   DON'T FORGET TO SAVE YOUR QR CODE. Registration starts from 6:00 pm to 6:30 pm only.
 <br>
●   ALWAYS FALL IN LINE while queuing in Photobooth, Photowall, Catering and Registration area to observe our social distancing.
<br>
●   CARRYING CONCEALED DEADLY WEAPONS IS STRICTLY PROHIBITED.
<br>
●   SMOKING INSIDE THE HALLS IS STRICTLY PROHIBITED. There are designated areas in the garden where you can smoke.
<br>
●   NO LITTERING. Observe cleanliness at all times.
<br>
●   BRINGING OF ALCOHOL OR OUTSIDE FOOD IS STRICTLY PROHIBITED.
<br>
●   REFRAIN FROM LOITERING especially when the program already started as we have performers, awardees, etc who will use the main stage and red carpet which we want all employees to watch clearly. 
<br>
●   PARKING SPACE IS LIMITED in the venue so for those who will bring their vehicles, available parking slot is in Exxa Tower. 
<br>
●   HR PERSONNEL IS ON STAND BY inside and outside the event hall. You may approach us for any concern/s. 
<br>
<input type="checkbox" name="terms" value="1" required><a style="color: white" href="{{route('qrterms')}}">I understand and agree to all the guidelines for the event.  </a>
                <br>
                <hr>
Thank You and Have a Great Time.
<br>
From Your HR Family. 

<hr>
                </div>

                
                <button type="submit" class="btn btn-outline-success btn-circle btn-lg btn-circle">Attend</button>
                <hr>
                </div>
                </form>
                @else
                <div class="card-header" style="text-align: center;">
                <h2>Simple QR Code</h2>
                </div>
                <div class="card-body" style="border: 5px solid;text-align: center;">
                    {!! QrCode::size(300)->generate( Auth::user()->id ) !!}

                    <h5 class="font-medium mb-0">{{ Auth::user()->emp_no }}</h5>
                    <h5 class="font-medium mb-0">{{ Auth::user()->name }}</h5>
                    <h5 class="font-medium mb-0">{{ Auth::user()->department }}</h5>
                    <h5 class="font-medium mb-0">{{ Auth::user()->location }}</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
