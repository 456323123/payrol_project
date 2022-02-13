@extends('layouts.admin')
@section('content')
<section id="basic-datatable">
<section id="basic-datatable">
<div class="row">
<div class="col-12">
<div class="card">
{{--  <div class="card-header">
<h4 class="card-title"> Employee Payroll
</h4>
</div>  --}}
<div class="card-content">
<div class="card-body card-dashboard">
<div class="row">
<div class="col-md-6">
     <h3 class="box-title">Employee Payroll  </h3>
<hr>
<form  method="post" action="{{ url('admin/search') }}">
@csrf
<div class="form-group">
<label for="first-name-icon">Cycle</label>

<div class="position-relative has-icon-left">
<select class="form-control cycle" name="cycle" placeholder="Cycle" required>
<option value="" >Select Cycle</option>

@foreach ($threshold as $list)
    <option value="{{ $list->days }}" cycle="{{ $list->days }}">
        {{ $list->cycle }}</option>
@endforeach

</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
{{-- <div class="row">
<div class="col-md-6"> --}}
<div class="form-group">
<label for="password-icon">start Date</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control" required
        name="start_date" placeholder="start date">
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>

{{--  <div class="form-group">
<label for="end_date">End Date</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control"
        name="end_date" placeholder="start date" required>
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>  --}}
{{-- </div>
<div class="col-md-6">
<div class="form-group">
<label for="password-icon">End Date</label>
<div class="position-relative has-icon-left">
    <input type="date" id="password-icon" class="form-control"
        name="end_date" placeholder="End date">
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>
</div>
</div>--}}
<div class="form-group">
<label for="first-name-icon">Dept</label>

<div class="position-relative has-icon-left">
<select type="text"   name="DEPARTMENT" list="Weekly" id="first-name-icon"
class="form-control" placeholder="Dept">
<option value="">Select Department</option>

@foreach ($department as $list)
    <option value="{{ $list->id }}">{{ $list->department }}
    </option>
@endforeach
</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
<div class="form-group">
<label for="first-name-icon">Emp</label>

<div class="position-relative has-icon-left">
<select type="text" list="Emp" name="Employee" id="first-name-icon"
class="form-control" placeholder="Emp">
<option value="">Select Employee</option>

@foreach ($users as $list)
    <option value="{{ $list->id }}">{{ $list->first_name }}
    </option>
@endforeach
</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>

<div class="btn-group pull-left">
<button type="reset" class="btn btn-warning pull-right">Reset</button>
</div>
<div class="btn-group pull-right">
<button type="submit" class="btn btn-success pull-right">Submit</button>
</div>


</form>
<br>
<div class="">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th scope="col">Employee Name</th>
<th scope="col">Hrs.</th>
<th scope="col">Processed</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
{{--  @foreach($user as  $value)


<tr>

    <th scope="row"> {{ $value->user->first_name ??'' }}</th>
    <td>        </td>
    <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
    <td><button type="button" atten="" total_hourse=""
            class="btn btn-info btn-sm"><i
                class="fa fa-fw fa-eye"></i></button></td>

</tr>
@endforeach  --}}


</tbody>
</table>
</div>

</div>
<div class="col-md-6">
<div class="">

<h3 class="box-title">Department &amp; Rate</h3>
<hr>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-6">Department: </div>
<div class="col-md-3 col-sm-6 col-xs-6"><strong class="department">Department Name</strong></div>
<div class="col-md-3 col-sm-6 col-xs-6">Regular Hours: </div>
<div class="col-md-3 col-sm-6 col-xs-6">8.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Overtime Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 overtime OTP">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">Hourly Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 hourly_rate">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus Rate: </div>
</div>

</div>
<div class="mt-4">

<h3 class="box-title">Pay Calculation</h3>
<hr>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-6">Employee: </div>
<div class="col-md-3 col-sm-6 col-xs-6"><strong class="first_name">Name</strong></div>
<div class="col-md-3 col-sm-6 col-xs-6">TRN: </div>
<div class="col-md-3 col-sm-6 col-xs-6">NIS:</div>
<div class="col-md-3 col-sm-6 col-xs-6">Work Hours: </div>
<div class="col-md-3 col-sm-6 col-xs-6 work_hours">0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Reg Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">OT Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6 OTP">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus:</div>
<div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Stat:</div>
</div>

</div>
<div class="box my-4">
<div class="box-body">
<h4>Payments</h4>
<div class="table-responsive no-padding">
<table class="table table-bordered" width="100%">
<tbody>
    <tr>
        <th>Description</th>
        <th>Hr/Day</th>
        <th>Rate</th>
        <th>Total</th>
    </tr>
    <tr>
        <th>Basic Pay</th>
        <td class="basichours">0.00</td>
        <td class="hourly_rate">$400.00</td>
        <td class="totalbasichours">$0.00</td>
    </tr>
    <tr>
        <th>Attn.Inc</th>
        <td>0.00</td>
        <td>$1.00</td>
        <td>$0.00</td>
    </tr>
    <tr>
        <th>Overtime</th>
        <td>0.00</td>
        <td>$270.00</td>
        <td>$0.00</td>
    </tr>
    <tr>
        <th>Bonus</th>
        <td>Selected Duration</td>
        <td>$0.00</td>
        <td>$0.00</td>
    </tr>
    <tr>
        <th colspan="3">Total</th>
        <td>$0.00</td>
    </tr>
</tbody>
</table>
</div>
<h4>Deductions</h4>
<div class="table-responsive no-padding">
<table class="table table-bordered" width="100%">
<tbody>
    <tr>
        <th colspan="2">Reason</th>
        <th>Amount</th>
    </tr>
    <tr>
        <th colspan="2">Total</th>
        <th>$0.00</th>
    </tr>
</tbody>
</table>
</div>
<h4>Net: $0.00</h4>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
        $('document').ready(function() {
            //alert();
        $('.btn-info').click(function() {
 var total_hourse=$(this).attr('total_hourse');

                     var atten_id=$(this).attr('atten');


        //   alert(atten_id);
          $.ajax({
              url:"{{url('atten_get')}}",
              type:"get",
              data:{
                  "atten_id":atten_id,"total_hourse":total_hourse
              },
              success: function (resutl) {
                $('.department').html(resutl.department);
                  $('.first_name').html(resutl.first_name);
                  $('.work_hours').html(resutl.total_hours);
                     $('.OTP').html('$'+resutl.orver_time_pay);
                    $('.hourly_rate').html('$'+resutl.hourly_rate);
                    $('.basichours').html(resutl.basichours);
            $('.totalbasichours').html('$'+resutl.totalbasichours);





              }
          });
         });
        });
        </script>
@endsection
