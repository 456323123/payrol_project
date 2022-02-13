@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}
<div class="card">
    <div class="card-header">
      <h4 class="card-title">Show All ProcessPay Rol List</h4>
    </div>


    <div class="card-content">
        <div class="card-body card-dashboard">
            <p class="card-text">ProcessPay List</p>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Pay</th>
                            <th>NIS</th>
                            <th>Income Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($processPayroll as $process)
                    <tr>
                        <td>{{$process->user_id}}</td>
                        <td>{{$process->start_date}}</td>
                        <td>{{$process->end_date}}</td>
                        <td>{{$process->total_pay}}</td>
                        <th>{{$process->nis}}</th>
                        <th>{{$process->income}}</th>
                    </tr>
                    @endforeach
    @endsection


     
    