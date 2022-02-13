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
<option value="">Select Cycle</option>

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
<label for="start_date">Duration</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control"
        name="start_date" placeholder="start date"  value="{{ old('start_date') }}" required>

    <input type="date" id="date-input" class="form-control"
        name="end_date" placeholder="end date"  value="{{ $end_date }}">

    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>

{{--  <div class="form-group">
<label for="end_date">Duration</label>
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
<select type="text" name="DEPARTMENT" list="Weekly" id="first-name-icon"
class="form-control"  placeholder="Dept" >
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
<select type="text" name="Employee" list="Emp" id="first-name-icon"
class="form-control"  placeholder="Emp">
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
<table class="table table-striped table-bordered mt-3">
<thead>
<tr>
<th scope="col">Employee Name</th>
<th scope="col">Hrs.</th>
<th scope="col">Processed</th>
   @php $department = App\Models\Permission::where(['user_id'=>auth()->user()->id,'module'=>'payrol','full_access'=>'1'])->count();@endphp   
                @if($department==1)
<th scope="col">Action</th>
@endif
</tr>
</thead>
<tbody>




@php
for($i = 0; $i<count($userArray)-1; $i+=1)

{ @endphp

<tr>

    <td scope="row">@php echo $userArray[$i+=1] @endphp</td>


 <td scope="row">@php
     $id = $userArray[$i-1];
    $basic = $userArray[$i+=1];
    $overTime = $userArray[$i+=1];
    $ip=intval($basic);

    $ip2 = intval($overTime);
        $bmin=gmdate("",$ip);

    $hoursBasictime=$ip/3600;

    $forBasicMin = floor($hoursBasictime);
    $mulBasic = $forBasicMin*3600;
    $totBasicMin = $ip-$mulBasic;
    $minBasic = $totBasicMin/60;


    $hoursOverTime = $ip2/3600;
    $basicOverMin = floor($hoursOverTime); //Total INT Hour divided *3600
    $totOverSec = $basicOverMin*3600;
    $totOverMinSec = $ip2-$totOverSec;
    $totOverTimeMin = $totOverMinSec/60;
    $totalhours=$forBasicMin+$hoursOverTime;


    $tempTotMin = $minBasic + $totOverTimeMin;
    $TotMin = 0;
    if($tempTotMin>=59) {
        $TotMin = $tempTotMin-59;
        $totalhours+=1;
    }
    else {
        $TotMin = $tempTotMin;
    }
        $totalMinFinal = 0;
        if($checkcycle==14){
        if(floor($totalhours)>80) {
            $hoursOverTime =(floor($totalhours))-80;
            $minBasic = 0;
            $hoursBasictime = 80;
            $totOverTimeMin = floor($TotMin);

        }
        else {
            $hoursOverTime = 0;
            $totOverTimeMin = 0;
            $minBasic = $TotMin;
        }

        }

        $acc = App\Models\Accumulate::get('accumalative_payrol_value')->last()->toArray();
        $acc_val = $acc['accumalative_payrol_value'];

        $process_count = App\Models\Proceed::where("user_id",$id)->count();
        $process = App\Models\Proceed::select(DB::raw('SUM(total_pay) as total_pay ,SUM(nis) as nis_total '))
        ->where("user_id",'26')->get()->toarray();

        $check_status = App\Models\Proceed::where("user_id",$id)->where('start_date',$startdate)
        ->where('end_date',$end_date)->count();


        $atten_get = App\Models\User::where('id', $id)->first();


        // Regular Hour's Pay Calculation's
        $hourlyRate = $atten_get->hourly_rate;
        $overTimeRate = $atten_get->ot_rate;
        $hRATE = intval($hourlyRate);
        $oRATE = intval($overTimeRate);

        $hoursREGPAY = floor($hoursBasictime) * $hRATE;
        $userBasicMin = ($hRATE / 60) * floor($minBasic);
        $total_basic_pay_rate = $hoursREGPAY + $userBasicMin;

        $Overtimepay = floor($hoursOverTime) * $oRATE;
        $overtimeminutespay = ($oRATE / 60) * floor($totOverTimeMin);
        $total_basic_pay = $Overtimepay + $overtimeminutespay;

        $totalUserSalary = $total_basic_pay_rate + $total_basic_pay;


        $USERNIS = App\Models\Deduction::select('nis_fix_value')->where('name','nis')->get()->toArray();
        $USERNIS = intval($USERNIS[0]['nis_fix_value']);
        $userSalaryNis = ($totalUserSalary/100)*$USERNIS;

        $tot_sal = 0;
        $tot_nis = 0;
        $income = 0;
        $inc_tax = 0;
        if($process_count==0) {
            $tot_sal = $totalUserSalary;
            $tot_nis = $userSalaryNis;
        }
        else {
            $tot_sal = $process[0]['total_pay']+$totalUserSalary;
            $tot_nis = $process[0]['nis_total']+$userSalaryNis;
        }
        if($tot_sal>$acc_val) {
            $income= ($tot_sal-$tot_nis-$acc_val);
            $inc_tax = ($income/100)*25;

        }
        else {
            $inc_tax = 0;
        }
    @endphp
        {{floor($totalhours)  }}: {{ floor($TotMin) }}
    {{ floor($hoursBasictime) }} : {{ floor($minBasic) }}
     {{ "/" }} {{  floor($hoursOverTime) }} {{ floor($totOverTimeMin) }}</td>
    @if($check_status>0)

        <td><i class="fa fa-fw fa-check approve" style="color: green;"></i></td>
    @else
        <td><i class="fa fa-fw fa-remove not-approve" style="color: rgb(250, 21, 40);"></i></td>

    @endif
     @php $department = App\Models\Permission::where(['user_id'=>auth()->user()->id,'module'=>'payrol','full_access'=>'1'])->count();@endphp   
                @if($department==1)

    <td><button class="btn btn-info senddata btn-sm" status={{ $check_status }} incometax={{ $inc_tax }} user_id={{ $id }} totalhours="{{ floor($totalhours)  }}"    totalm="{{ floor($TotMin) }}"
         hoursBasihourctime="{{ floor($hoursBasictime) }}"  minBasic="{{ floor($minBasic)}}"     hoursOverTime={{  floor($hoursOverTime) }}  totOverTimeMin="{{ floor($totOverTimeMin) }}"><i
                    class="fa fa-fw fa-eye"></i></button></td>

@endif
</tr>



@php  } @endphp



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
<div class="col-md-3 col-sm-6 col-xs-6 regular_hours">0</div>
<div class="col-md-3 col-sm-6 col-xs-6">Overtime Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 over_time_rate">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">Hourly Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 hourly_rate">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus Rate:</div>

</div>

</div>
<div class="mt-4">

<h3 class="box-title">Pay Calculation</h3>
<hr>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-6">Employee: </div>
<div class="col-md-3 col-sm-6 col-xs-6"><strong class="first_name">Name</strong></div>
<div class="col-md-3 col-sm-6 col-xs-6">TRN: </div>
<div class="col-md-3 col-sm-6 col-xs-6 trn">0</div>
<div class="col-md-3 col-sm-6 col-xs-6">NIS: </div>
<div class="col-md-3 col-sm-6 col-xs-6 nis">0</div>
<br>

<div class="col-md-3 col-sm-6 col-xs-6">Work Hours: </div>
<div class="col-md-3 col-sm-6 col-xs-6 total_work_hours_and_minits">0.00</div>

<div class="col-md-3 col-sm-6 col-xs-6">Reg Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6 total_basic_pay">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">OT Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6 total_over_time_pay">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus:</div>
<div class="col-md-3 col-sm-6 col-xs-6">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6">Stat:<div class="user_stat"></div></div>
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
        <td class="total_work_Basic_hours_and_minits">0.00</td>
        <td class="hourly_rate">$0.00</td>
        <td class="total_basic_pay">$0.00</td>
    </tr>

    <tr>
        <th>Overtime</th>
        <td class="total_work_Over_hours_and_minits">0.00</td>
        <td class="over_time_rate">$0.00</td>
        <td class="total_over_time_pay ">$0.00</td>
    </tr>
    <tr>
        <th>Bonus</th>
        <td>Period Bonus</td>
        <td class="bonuspay">$0.00</td>
        <td class="">$0.00</td>
    </tr>

    <tr>
        <th>Total</th>
        <td></td>
        <td class="rate">$0.00</td>
        <td class="sum_basic_and_over_pay">$0.00</td>

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
    <input type="hidden" class="user_id">
    <tr>
        <td colspan="2">NIS</td>
        <td class="NIS_ANS"></td>
    </tr>
    <tr>
        <td colspan="2">NHT</td>
        <td class="NIS_NHT"></td>
    </tr>
    <tr>
        <td colspan="2">ED TAX</td>
        <td class="NIS_EDT"></td>
    </tr>
    <tr>
        <td colspan="2">INCOME TAX</td>
        <td class="user_incometax"></td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td class="total-deduction">$0.00</td>
    </tr>
</tbody>
</table>
</div>
<h4 >Net Pay:<span class="netpay">0.00</span> </h4>
<input type="hidden" class="start_date" value="{{$startdate}}">
<input type="hidden" class="end_date" value="{{$end_date}}">
     @php $department = App\Models\Permission::where(['user_id'=>auth()->user()->id,'module'=>'payrol','full_access'=>'1'])->count();@endphp   
                @if($department==1)

<div class="btn-group pull-right">
<button type="button" class="btn btn-info pull-right proceed" >Proceed</button>
</div>
@endif
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
            var approve_status;
            var after_income;
        $('.senddata').click(function() {
var start_date=$('.start_date').val();
var end_date=$('.end_date').val();

                     var user_id=$(this).attr('user_id');
                     var totalhours=$(this).attr('totalhours');
                     var totalm=$(this).attr('totalm');
                     var hoursBasihourctime=$(this).attr('hoursBasihourctime');

                     var minBasic=$(this).attr('minBasic');

                     var hoursOverTime=$(this).attr('hoursOverTime');

                     var totOverTimeMin=$(this).attr('totOverTimeMin');
                     var incometax=$(this).attr('incometax');
                     var after_income=$(this).attr('incometax');
                     after_income = parseFloat(after_income);
                     var status = $(this).attr('status');
                     if(status==0) {
                        $('.user_stat').html('<i class="fa fa-fw fa-remove" style="color: red;"></i>');
                        var approve_status = $('.user_stat').html();
                     }
                     else if(status>0) {
                        $('.user_stat').html('<i class="fa fa-fw fa-check approve approve" style="color: green;"></i>');
                        var approve_status = $('.user_stat').html();
                     }


        //   alert(atten_id);
          $.ajax({
              url:"{{url('atten_get')}}",
              type:"get",
              data:{
                  "user_id":user_id,"start_date":start_date,"end_date":end_date,"totalhours":totalhours,"totalm":totalm,"hoursBasihourctime":hoursBasihourctime,
                  "minBasic":minBasic, 'hoursOverTime':hoursOverTime,'totOverTimeMin':totOverTimeMin,'incometax':incometax
              },
              success: function (resutl) {
                $('.department').html(resutl.department);
                  $('.first_name').html(resutl.first_name);
                  $('.totalhors').html(resutl.totalhors);
                     $('.over_time_rate').html('$'+resutl.over_time_rate);
                    $('.hourly_rate').html('$'+resutl.hourly_rate);
                    $('.trn').html(resutl.trn);
                    $('.nis').html(resutl.nis);
                    $('.bonuspay').html('$'+resutl.bonusPay);

                    $('.total_work_hours_and_minits').html(resutl.total_work_hours_and_minits);
            $('.total_basic_pay').html('$'+resutl.total_basic_pay);
            $('.total_over_time_pay').html('$'+resutl.total_over_time_pay);

                    $('.regular_hours').html(resutl.regular_hours);

            $('.totalbasichours').html('$'+resutl.totalbasichours);
                        $('.total_work_Over_hours_and_minits').html(resutl.total_work_Over_hours_and_minits);

            $('.total_work_Basic_hours_and_minits').html(resutl.total_work_Basic_hours_and_minits);
            $('.totalovertime').html('$'+resutl.totalovertime);
            $('.user_id').val(resutl.id_user);
           $('.sum_basic_and_over_pay').html('$'+resutl.sum);
           $('.user_incometax').html(resutl.user_incometax);
              var Sum = resutl.sum;

 var nis=resutl.nis_value_percentage;
var nht=resutl.nht_value_percentage;
 var edtax=resutl.edtax_value_percentage;
 {{--  alert(edtax);  --}}
 var incomeTaxPercentage =25;
 var nisLimit=resutl.nis_limit_value;
var INCOMETHRESHOLD=50000;
 var cal_nis=(Sum/100)*nis;
  if(cal_nis>nisLimit)
{
    cal_nis = nisLimit;
}
cal_nis = cal_nis.toFixed(2);
var cal_nht=(Sum/100)*nht;
cal_nht = cal_nht.toFixed(2);
var cal_edt = ((Sum-cal_nis)/100)*edtax;
cal_edt = cal_edt.toFixed(2);

$('.NIS_ANS').text(cal_nis) ;
$('.NIS_NHT').text(cal_nht);
$('.NIS_EDT').text(cal_edt);
var tot_sal = $('.sum_basic_and_over_pay').text().split("$");

after_income = after_income.toFixed(2);
var sum_deductions = parseFloat(cal_edt)+parseFloat(cal_nis)+parseFloat(cal_nht)+parseFloat(after_income);
sum_deductions = sum_deductions.toFixed(2);
$('.total-deduction').text(sum_deductions);


var net_pay = tot_sal[1] - sum_deductions;
var fixedNet_apy = parseFloat(net_pay).toFixed(2)
var rate_sum = parseInt(resutl.rate)+parseInt(resutl.bonusPay);
$('.netpay').text(fixedNet_apy);
            $('.rate').html('$'+rate_sum);
var income=$('.income_tax_hd').val();
$('.INC_TAX').text(income);

              }
          });
         });


 $('.proceed').click(function() {
                var a=  $('.first_name').text();
                      var id=  $('.user_id').val();

           var nis=     $('.NIS_ANS').text();

 var nht=$('.NIS_NHT').text();
var edtax=$('.NIS_EDT').text();
                var s_d = $('.start_date').val();
                var e_d = $('.end_date').val();
var netpay=$('.netpay').text();

var income_save=$('.user_incometax').text();

//alert(netpay);
 $.ajax({
              url:"{{url('admin/proceed')}}",
              type:"get",
              data:{
                  "user_id":id,"start_date":s_d,"end_date":e_d,"nis":nis,
                  "nht":nht, 'edtax':edtax,'netpay':netpay,'income_save':income_save
              },
              success: function (resutl) {
                  if(resutl==0) {
                      toastr.success("Payroll Added");
                  }
                  else {
                    toastr.error("Payroll Already Exist");
                  }
              }
          });
        });



        });
        </script>
@endsection