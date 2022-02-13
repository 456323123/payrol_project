@extends('layouts.admin')
@section('content')

<?php
use Carbon\Carbon;
use App\Models\Attendence;


?>
@php
$dep = DB::table('departments')->get();
$user = DB::table('users')->select('id','first_name','last_name','user_role')->where('user_role','user')->get();
@endphp


 <section id="basic-datatable">

 <form  action="{{route('admin.attendance_search')}}" method="get" style="background-color: white;">
     @if($Employepermision['full_access']==1 )

  <div class="row justify-content-center">

           <div class="col-12 col-md-3 mt-2 " >
               <div class="form-group">
   <div class="controls">

    <input type="text" id="date-input" class="form-control"  placeholder="Start date"
                    onfocus="(this.type='date')"
        name="start_date" placeholder="start date"  value="{{ old('start_date') }}" required>
   </div>
               </div>
           </div>



            <div class="col-12 col-md-3 mt-2" >
               <div class="form-group">
   <div class="controls">
<input class="form-control "    placeholder="End date"
                    onfocus="(this.type='date')"   type="text" id="range" name="end_date" placeholder="select date range" required  >
   </div>
               </div>
           </div>

<div class="col-12 col-md-3 mt-2 " >
<div class="form-group">
                                                        <div class="controls">

                                <select class="form-control select" name="department" placeholder="Department" >
        <option value="" >select Department</option>
        @foreach ($dep as $list)
            <option value="{{ $list->id }}" >
                {{ $list->department }}</option>
        @endforeach
    </select>
                                                        </div>
                                                    </div>
                                                   </div>








 <div class="col-12 col-md-2 mt-2" >
<div class="form-group">

                                                   <div class="form-group  ">
                        <button type="submit" class="btn  btn-primary "><i class="fa fa-search"> </i> Search</button>
                  <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addattendance">
New                  </button>
                    </div>
                                    </div>
 </div>
  </div>



                    </form>
                    @endif
</div>

  <div class="row">

      <div class="col-12">

          <div class="card" style="box-shadow: none;">


              <div class="card-content">
                  <div class="card-body card-dashboard" style="mt--5">
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                      <th>#id</th>
                                      <th>Employee Name</th>
                                      <th>In Time</th>
                                      <th>Out Time</th>
                                      <th>Work Time</th>
                                      <th>Basic Hours</th>
                                 @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                      <th>Over Time</th>
                                      <th>Action</th>
                                      @endif

                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                    $user_name=Auth::user()->first_name;
                                @endphp
                                @foreach($emp_atten as $list)

                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$list->first_name}}</td>
                                      <td>{{$list->date}} - {{$list->start_time}}</td>
                                        @if($list->end_time==0)

                                          <td>00:00:00</td>

                                        @else
                                        <td>{{$list->date}} - {{$list->end_time}}</td>

                                    @endif
                                          <td>{{ $list->work_time}}</td>

                                        @if($list->status == 0)
                                            <td>08:00:00</td>
                                        @else
                                        <td>08:00:00 / {{  $list->work_time}}</td>
                                    @endif
                                                @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                        <td>{{$list->overtime}}</td>
                                        @if($list->status == 0)
                                            <td><a class="btn btn-success" href="{{ route('admin.attent_status_approve', $list->id)}}" style="color: white;">Approve</a></td>
                                        @else
                                        <td><a class="btn btn-info" href="{{ route('admin.attent_status_disapprove',$list->id) }}" style="color: white;">Disapprove</a></td>
                                    @endif
                                    @endif
                                  </tr>
                                @endforeach
                              </tbody>

                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="addattendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Attendance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.add.admin_attendance')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Select Date</label>
                <div class="position-relative has-icon-left">
                  <input required type="date" name="date" class="form-control  @error('department_name') is-invalid @enderror"  >
                  @error('department_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


                    <label for="first-name-icon">start Time</label>
                <div class="position-relative has-icon-left">
                  <input required type="time" name="start_time" class="form-control  @error('department_name') is-invalid @enderror"  >
                  @error('department_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>



                    <label for="first-name-icon">End Time</label>
                <div class="position-relative has-icon-left">
                  <input required type="time" name="end_time" class="form-control  @error('department_name') is-invalid @enderror"  >
                  @error('department_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                         <label for="first-name-icon">Users</label>
                <div class="position-relative has-icon-left">
             <select class="select2 form-control" name="user"  required>
        <option value="" >select user</option>
        @foreach ($user as $list)
            <option value="{{ $list->id }}" >
                {{ $list->first_name }} {{ $list->last_name }}</option>
        @endforeach
    </select>
                </div>


            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Add Attendance</button>
        </div>
    </form>

      </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $("#filter_attendance").click(function(){
        $.ajax({
              url:"{{url('admin/filter_attendance')}}",
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
</section>
@endsection

