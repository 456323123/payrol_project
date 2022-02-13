@extends('layouts.admin')
@section('content')

<?php
use Carbon\Carbon;
use App\Models\Attendence;


?>
 <section id="basic-datatable">
  <div class="row">
      <div class="col-12">
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
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Threshold List</h4>
                  <a href="{{url('admin/add_threshold')}}" class="btn btn-primary float-right">
                    Add Threshold
                  </a>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Threshold List</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                      <th>#id</th>
                                      <th>Year</th>
                                      <th>Cycle</th>
                                      <th>Pay</th>
                                      <th>Days</th>
                                      <th>Calculated By</th>
                         @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                      <th>Action</th>
                                      @endif

                                  </tr>
                              </thead>
                              <tbody>
                                 
                                      @php
                                          $i=1;
                                      @endphp
                               @foreach($threshold as $list)
                               <tr>
                                <td>{{$i++}}</td>
                                <td>{{$list->year}}</td>
                                <td>{{$list->cycle}}</td>
                                <td>{{$list->amount}}</td>
                                <td>{{$list->days}}</td>
                                <td>{{$list->paid_by}}</td>
                                                         @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                <td>

                                    <a href="{{url('admin/edit_threshold')}}/{{$list->id}}" class="text-primary mr-2"><i class="feather icon-edit" title="Edit"></i></a>
                                    @endif
                     @if($Employepermision['full_access']==1 )

                                    <a href="{{url('admin/delete_threshold')}}/{{$list->id}}" class="text-danger"><i class="feather icon-trash " title="Delete"></i></a>
                                </td>
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
