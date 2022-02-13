@extends('Employee.layouts.main')
@section('content')
<?php
use Carbon\Carbon;
use App\Models\Attendence;


?>
 <section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Show All Attendance List</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Attendance List</p>
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
                                      <th>Over Time</th>
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
                                      <td>{{$user_name}}</td>
                                      <td>{{$list->date}} - {{$list->start_time}}</td>
                                        @if($list->end_time==0)

                                          <td>00:00:00</td>

                                      @else
                                    <td>{{$list->date}} - {{$list->end_time}}</td>

                                @endif
                                    @if($list->status==0)
                                          <td>{{ $list->work_time}}</td>
                                    @else
                                @php


                $total_time_seconnds= Carbon::parse($list->start_time)->diffInSeconds($list->end_time);



$before =gmdate("H:i:s", $total_time_seconnds);
                                @endphp

                                      <td>{{ $before}}</td>

  @endif
                                      @if($list->end_time==0)

                                      <td>00:00:00</td>

                                      @else
                                                                            <td>08:00:00 / {{  $list->work_time}}</td>
@endif
                                      @if($list->status == 0)
                                      <td>00:00:00</td>
                                        @else
                                        <td>{{ $list->overtime }}</td>
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
  </div>
</section>
</div>
@endsection
