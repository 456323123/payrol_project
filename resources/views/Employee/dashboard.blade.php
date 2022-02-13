@extends('Employee.layouts.main')

<style>
    html {
        /* background: #282828; */
        text-align: center;
        font-size: 10px;
    }

    /* body {
  margin: 0;
  font-size: 2rem;
  display: flex;
  flex: 1;
  min-height: 100vh;
  align-items: center;
} */

    .clock {
        width: 23rem;
        height: 23rem;
        position: relative;
        padding: 2rem;
        border: 7px solid #282828;
        box-shadow: -4px -4px 10px rgba(67, 67, 67, 0.5),
            inset 4px 4px 10px rgba(0, 0, 0, 0.5),
            inset -4px -4px 10px rgba(67, 67, 67, 0.5),
            4px 4px 10px rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        margin: 50px auto;

    }

    .outer-clock-face {
        position: relative;
        background: #282828;
        overflow: hidden;
        width: 100%;
        height: 100%;
        border-radius: 100%;
    }

    .outer-clock-face::after {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        transform: rotate(90deg)
    }

    .outer-clock-face::after,
    .outer-clock-face::before,
    .outer-clock-face .marking {
        content: '';
        position: absolute;
        width: 5px;
        height: 100%;
        background: #1df52f;
        z-index: 0;
        left: 49%;
    }

    .outer-clock-face .marking {
        background: #bdbdcb;
        width: 3px;
    }

    .outer-clock-face .marking.marking-one {
        -webkit-transform: rotate(30deg);
        -moz-transform: rotate(30deg);
        transform: rotate(30deg)
    }

    .outer-clock-face .marking.marking-two {
        -webkit-transform: rotate(60deg);
        -moz-transform: rotate(60deg);
        transform: rotate(60deg)
    }

    .outer-clock-face .marking.marking-three {
        -webkit-transform: rotate(120deg);
        -moz-transform: rotate(120deg);
        transform: rotate(120deg)
    }

    .outer-clock-face .marking.marking-four {
        -webkit-transform: rotate(150deg);
        -moz-transform: rotate(150deg);
        transform: rotate(150deg)
    }

    .inner-clock-face {
        position: absolute;
        top: 10%;
        left: 10%;
        width: 80%;
        height: 80%;
        background: #282828;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        z-index: 1;
    }

    .inner-clock-face::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        border-radius: 18px;
        margin-left: -9px;
        margin-top: -6px;
        background: #4d4b63;
        z-index: 11;
    }

    .hand {
        width: 50%;
        right: 50%;
        height: 6px;
        background: #61afff;
        position: absolute;
        top: 50%;
        border-radius: 6px;
        transform-origin: 100%;
        transform: rotate(90deg);
        transition-timing-function: cubic-bezier(0.1, 2.7, 0.58, 1);
    }

    .hand.hour-hand {
        width: 30%;
        z-index: 3;
    }

    .hand.min-hand {
        height: 3px;
        z-index: 10;
        width: 40%;
    }

    .hand.second-hand {
        background: #ee791a;
        width: 45%;
        height: 2px;
    }

</style>
@section('content')
{{-- <div id="time"></div> --}}

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="clock">


                    <div class="outer-clock-face">

                        <div class="marking marking-one"></div>
                        <div class="marking marking-two"></div>
                        <div class="marking marking-three"></div>
                        <div class="marking marking-four"></div>

                        <div class="inner-clock-face">

                            <div class="hand hour-hand"></div>
                            <div class="hand min-hand"></div>
                            <div class="hand second-hand"></div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body px-0 pb-0">
                        <div id="goal-overview-chart" class="mt-75"></div>
                        <div class="row text-center mx-0">
                            <div class="col-6 border-top border-right d-flex align-items-between flex-column py-1">
                                <form action="{{ url('employee/start-time') }}" method="post">
                                    @csrf
                                                                         {{-- <input type="text" name="start_time_get" class="time"> --}}

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    {{-- <div class="form-group">
                  <label for="first-name-icon">In Time</label>
                  <div class="position-relative has-icon-left">
                    <input type="time" name="start_time" class="form-control  @error('start_time') is-invalid @enderror"  >
                    @error('start_time')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

              </div> --}}

                                    {{-- <div class="form-group">
                <label for="first-name-icon">Out Time</label>
                <div class="position-relative has-icon-left">
                  <input type="time" name="end_time" class="form-control  @error('end_time') is-invalid @enderror"  >
                  @error('end_time')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>

            </div> --}}
                                    @if (isset($start_time->id))
                                        <button type="submit" disabled class="btn btn-success mb-2">
                                            {{ $start_time->start_time }}</button>
                                        <p>In Time</p>

                                    @else
                                        <button type="submit" class="btn btn-primary mb-2">In Time Attendence</button>
                                    @endif
                                </form>
                            </div>
                            <div class="col-6 border-top d-flex align-items-between flex-column py-1">
                                <form action="{{ url('employee/end-time') }}" method="post">
                                                                         {{-- <input type="text" name="start_time_get" class="time"> --}}
                                    @csrf
                                    @if (isset($start_time->id))
                                        <input type="hidden" name="atten_id" value="{{ $start_time->id }}">


                                    @else
                                        <input type="hidden" name="atten_id" value="0">
                                    @endif
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @if (isset($start_time->end_time))
                                        <button type="submit" disabled class="btn btn-success mb-2">
                                            {{ $start_time->end_time }}</button>
                                        <p>Out Time</p>

                                    @else
                                        @if (isset($start_time->start_time))

                                            <button type="submit" class="btn btn-primary mb-2">Out Time Attendence</button>
                                        @else
                                            <button type="submit" disabled class="btn btn-primary mb-2">Out Time
                                                Attendence</button>

                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
           $(document).ready(function(){
           });
       function Timer() {
    var dt = new Date()
    if (dt.getHours() >= 12){
        ampm = "PM";
    } else {
        ampm = "AM";
    }
    if (dt.getHours() < 10) {
        hour = "0" + dt.getHours();
    } else {
        hour = dt.getHours();
    }
    if (dt.getMinutes() < 10) {
        minute = "0" + dt.getMinutes();
    } else {
        minute = dt.getMinutes();
    }
    if (dt.getSeconds() < 10) {
        second = "0" + dt.getSeconds();
    } else {
        second = dt.getSeconds();
    }
    if (dt.getHours() > 12) {
        hour = dt.getHours() - 12;
    } else {
        hour = dt.getHours();
    }
    if (hour < 10) {
        hour = "0" + hour;
    } else {
        hour = hour;
    }
      var time=  hour + ":" + minute + ":" + second + " " + ampm;

    $('.time').val(time);
    setTimeout("Timer()", 1000);
}
Timer();

        const secondHand = document.querySelector('.second-hand');
        const minsHand = document.querySelector('.min-hand');
        const hourHand = document.querySelector('.hour-hand');

        function setDate() {
            const now = new Date();

            const seconds = now.getSeconds();
            const secondsDegrees = ((seconds / 60) * 360) + 90;
            secondHand.style.transform = `rotate(${secondsDegrees}deg)`;

            const mins = now.getMinutes();
            const minsDegrees = ((mins / 60) * 360) + ((seconds / 60) * 6) + 90;
            minsHand.style.transform = `rotate(${minsDegrees}deg)`;

            const hour = now.getHours();
            const hourDegrees = ((hour / 12) * 360) + ((mins / 60) * 30) + 90;
            hourHand.style.transform = `rotate(${hourDegrees}deg)`;
        }

        setInterval(setDate, 1000);

        setDate();
    </script>


@endsection
