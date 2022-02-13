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

 <form  action="{{route('bonus')}}" method="get" style="background-color: white;">
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
                                      <th>user id</th>
                                      <th>Employee Name</th>
                                      <th>Pay Period From</th>
                                      <th>Pay Period To</th>
                                      <th>Bonus</th>

                                      <th>Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <form  action="{{route('storeboubus')}}" method="post" style="background-color: white;">
                                 @csrf
                                    @foreach($users as $value)


<tr>
<td><input type="text" value="{{  $value->id  }}" name="user_id[]" readonly style="border-radius: none;  outline: none;
 border:none;">        <td><input type="text" value="{{  $value->first_name  }}" name="first_name[]" readonly style="border-radius: none;  outline: none;
 border:none;"><input type="text" value="{{   $value->last_name  }}" name="last_name[]" readonly style="margin-left: -113px;border-radius: none;  outline: none;
 border:none;"></td>


<td><input type="text" value="{{   $period_from  }}" name="period_from[]" readonly style="border-radius: none;  outline: none;
 border:none;"></td>
<td><input type="text" value="{{   $period_to  }}" name="period_to[]" readonly style="border-radius: none; outline: none;border:none;"></td>
    <td><input  type="number"  name="bonus[]"  value="0"></td>


                                  </tr>
 @endforeach


                              </tbody>

                          </table>
                           <button type="submit" class="btn btn-primary">save</button>
</form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </form>

      </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>

</section>
@endsection

