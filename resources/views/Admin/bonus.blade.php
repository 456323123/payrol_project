@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}
<div class="card">
    <div class="card-header">
      <h4 class="card-title">Show All Bonuses</h4>
    </div>


    <div class="card-content">
        @if ($message = Session::get('success'))
                  <div class="alert alert-success ">    
                      <strong>{{ $message }}</strong>
                  </div>
        @endif
        @if ($message = Session::get('error'))
                  <div class="alert alert-danger ">    
                      <strong>{{ $message }}</strong>
                  </div>
        @endif 
        <div class="card-body card-dashboard">
            <p class="card-text">Bonus List</p>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Employee Name</th>
                            <th>Pay Period From</th>
                            <th>Pay Period To</th>
                            <th>Bonus</th>
                                                                            @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bonusData as $bonus)
                    <tr>
                        <td>{{$bonus->user_id}}</td>
                        <td>{{$bonus->name}}</td>
                        <td>{{$bonus->start_date}}</td>
                        <td>{{$bonus->end_date}}</td>
                        <td>{{$bonus->bonus}}</td>
                        @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                        <td>
                            <a href="{{url('admin/edit_bonus',$bonus->user_id.'/'.$bonus->start_date.'/'.$bonus->end_date)}}" class="text-primary mr-2"><i class="feather icon-edit" title="Edit"></i></a>
                        </td>
@endif
                    </tr>
                    @endforeach
    @endsection


     
    