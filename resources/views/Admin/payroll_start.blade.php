@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}
<div class="card">
    <div class="card-header">
      <h4 class="card-title">Payroll Start Date</h4>
         @if( $Employepermision['full_access']==1 )

      <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">NEW</button>
      @endif
    </div>


    <div class="card-content">
        <div class="card-body card-dashboard">
            <p class="card-text">Year Wise List</p>
            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Start Date</th>
                            <th>Year</th>
                      @if( $Employepermision['edit_access']==1 )

                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($payroll_s as $payroll)
                    <tr>
                        <td>{{$payroll->id}}</td>
                        <td>{{$payroll->start_date}}</td>
                        <td>{{$payroll->Year}}</td>
                   @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                        <td>
                            <a href="{{url('admin/edit_payroll_start',$payroll->id)}}" class="text-primary mr-2"><i class="feather icon-edit" title="Edit"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach









  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="get" action="{{url('admin/add_start_date')}}">
            <div class="modal-body">
                <div class="form-group">
                    <div class="position-relative has-icon-left">
                        <input type="date" class="form-control"  name="start_d" placeholder="Start Date" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

    @endsection
