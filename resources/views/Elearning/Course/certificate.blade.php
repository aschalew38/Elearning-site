<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
        <style>
            .col-md-10{
                width: 92%;
                margin-left: 4%;
            }
            .p-4{
                /* padding: 1.5rem; */
            }
            .shadow{
                /* box-shadow: 0.1rem 0.1rem 0.1rem rgb(0, 0, 0,0.15) */
            }
            .border{
                /* border: 1px solid black; */

            }
            .d-flex{
                display: flex;

            }

        </style>
            <link href="BackEnd/assets/css/bootstrap.min.css' " rel="stylesheet" type="text/css" />

    </head>
    <body>

    <div class="col-md-10 border">
        <div style="border: 4px ridge rgba(211, 220, 50, .6);" class="" id="certificate">

            <div class="border-1">
                {{-- <hr class="" style="height:2px;color:rgba(211, 220, 50, .6);transform: translate(0px, 33px);z-index:1"> --}}
                <div  style="border:1px solid black;
                            display:flex;
                            flex-direction: row-reverse;
                            justify-content: right;"
                 {{-- class="border-black-2 d-flex justify-content-end mx-4" --}}
                 >
                    <img src="{{ $logo }}" height="100px" width="" style="z-index:1;margin-left:75%;margin-right: 5%" />
                    <hr>
                </div>
                <hr class="" style="height:2px;color:rgba(211, 220, 50, .6);transform: translate(0px, -37px);">
            </div>
            <div class="col-10 mx-au" style="width: 80%;margin-left:10%">
                <h1>Digital Solution</h1>
                <h2>Certificate of Course Completion</h2>
                {{-- <h6>Congratulations {{ $user->name }}</h6> --}}
            </div>
            <div class="" style="padding: 1px 20px;width:80%;margin-left:10%;">
                {{-- <h5>{{ $course->name }}</h5> --}}
                <p >Course completed on {{ $completed }} </p>
                <p> Total
                    Hour:{{ date('H:i', mktime(0, $course->minutes)) }} hours</p>
            </div>
            <div class="col-10 mx-auto" style="width: 80%;margin-left:10%">

                <p class="text-primary" style="text-align: justify; font-style: italic;font-size: 1.2rem;line-height: 1.5">Congratulations on
                    completing your
                    training certificate!
                     You have shown great
                    dedication and
                    perseverance in pursuing your goals. You should be proud of yourself and your achievements. You have
                    learned valuable skills and knowledge that will help you in your future endeavors. Remember, this is not
                    the end of your journey, but the beginning of a new one. Keep up the good work and never stop learning
                    and growing. You have what it takes to succeed!</p>
            </div>

            <table style="width: 80%;margin-left:10%;">
            {{-- <table> --}}
                <tr>
                    <td>

                        <img src="sign.png" height="100px" style="z-index:1" />
                    </td>
                    <td>
                        <h4>Head of Digital Solution, learning</h4>
                        <p>Kebebew Ababu(Assistant Professor)</p>
                        <p>Addis Abeba, Ethiopia</p>
                    </td>
                </tr>
            </table>
            {{-- </table> --}}

        </div>

    </div>

</body>
</html>
