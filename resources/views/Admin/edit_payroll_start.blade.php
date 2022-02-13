@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}
<div class="card">
    <div class="card-header">
      <h4 class="card-title">Payroll Start Date</h4>
    </div>


    <div class="card-content">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="my-5" method="post" action="{{url('admin/update_payroll_start',$payroll->id)}}" >
                    @csrf
                    <div class="form-group">
                        <label for="first-name-icon">Edit Payroll Date</label>

                        <div class="position-relative has-icon-left">
                            <input type="text" class="form-control" value={{ $payroll->start_date }} name="s_d" placeholder="bonus" >
                        </div>

                    </div>
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
                <br>
            </div>

        </div>
    </div>






    @endsection
