@extends('BackEnd.Layout.base')

{{-- @section('title', $course->name) --}}
@section('content')
    <div class="col-md-10 border shadow p-4 ">
        <div style="border: 4px ridge rgba(211, 220, 50, .6);" class="" id="certificate">
            <div class="border-1">
                <hr class="" style="height:2px;color:rgba(211, 220, 50, .6);transform: translate(0px, 33px);z-index:1">
                <div class="border-black-2 d-flex justify-content-end mx-4">
                    {{-- <img src="{{ asset('BackEnd/assets/images/stm.png') }}" height="100px" style="z-index:1" /> --}}
                    <hr>
                </div>
                <hr class="" style="height:2px;color:rgba(211, 220, 50, .6);transform: translate(0px, -37px);">
            </div>
            <div class="col-10 mx-auto my-4">
                <h5>Digital Solution</h5>
                <h4>Certificate of Course Completion</h4>
                {{-- <h6>Congratulations {{ $user->name }}</h6> --}}
            </div>
            <div class="my-4 col-10 mx-auto p-4">
                {{-- <h5>{{ $course->name }}</h5> --}}
                <p>Course completed on August 18,2023 </p>
                <p> Total
                    {{-- Hour:{{ date('H:i', mktime(0, $course->minutes)) }} hours</p> --}}
            </div>
            <div class="col-10 mx-auto">

                <p class="text-primary" style="text-align: justify; font-style: italic;font-size: 1.2rem">Congratulations on
                    completing your
                    training certificate!
                    🎉 You have shown great
                    dedication and
                    perseverance in pursuing your goals. You should be proud of yourself and your achievements. You have
                    learned valuable skills and knowledge that will help you in your future endeavors. Remember, this is not
                    the end of your journey, but the beginning of a new one. Keep up the good work and never stop learning
                    and growing. You have what it takes to succeed!</p>
            </div>
            <div class="col-10 mx-auto p-4 d-flex">
                <div class="col-5 flex-col" style="border-right: solid 1px gray;">
                    {{-- <img src="{{ asset('BackEnd/assets/images/sign.png') }}" height="100px" style="z-index:1" /> --}}
                    <h6>Head of Digital Solution, learning</h6>
                </div>
                <div class="col-6 mt-4 px-4">
                    <p>Kebebew Ababu(Assistant Professor)</p>
                    <p>Addis Abeba, Ethiopia</p>
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-end m-4">
            <button id="printBtn" onclick="printPart()" class="btn btn-primary">Print</button>

        </div> --}}
    </div>
@endsection
@push('js')
    {{-- <script src="{{ asset('BackEnd/plugins/repeater/jquery.repeater.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script> --}}
    {{-- <script src="{{ asset('BackEnd/assets/pages/jquery.form-repeater.js') }}"></script> --}}
    <script>
        // Print part of a   webpage by element id
        function printPart() {
            // alert();
            // Get the element by id
            var element = document.getElementById("certificate");

            // Create a new window
            var win = window.open('', 'Print', 'height=600,width=800');

            // Write the element content to the window
            win.document.write(element.innerHTML);

            // Print the window
            win.print();

            // Close the window
            win.close();
        }
    </script>
@endpush
