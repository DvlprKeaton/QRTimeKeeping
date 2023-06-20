@extends('layouts.app')

@section('content')
<div class="container mt-4">

        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h2>QR Scanner Code</h2>
            </div>

            <div class="card-body" style="border: 5px solid;text-align: center;">
                <div id="reader" width="600px"></div> 

                <input type="hidden" name="results" id="results" value="">
                <input type="hidden" name="idd" id="idd" value="">
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
         
         console.log(`Code matched = ${decodedText}`, decodedResult);

         let id = document.getElementById("results").value = decodedText;            
                html5QrcodeScanner.clear().then(_ => {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        
                        url: "{{ route('qrresults') }}",
                        type: 'POST',            
                        data: {
                            _methode : "POST",
                            _token: CSRF_TOKEN, 
                            qr_code : id
                        },            
                        success: function (response) { 


                            var data = response.selectedUser;
                            var fins = document.getElementById("idd").value = response.selectedUser;

                            if(response.status == 200){
                                    fin = document.getElementById("idd").value;
                                    console.log(data, fin);
                                window.location.href = "{{ route('qrsuccess') }}";
                            }else if(response.status == 600){
                                window.location.href = "{{ route('qrscanned')}}";
                            }else{
                                window.location.href = "{{ route('qrfailed')}}";
                            }
                            
                        }
                    });   
                }).catch(error => {
                    alert('something wrong');
                });
        }

        function onScanFailure(error) {
          // handle scan failure, usually better to ignore and keep scanning.
          // for example:
          //console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
          "reader",
          { fps: 10, qrbox: {width: 250, height: 250} },
          /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
