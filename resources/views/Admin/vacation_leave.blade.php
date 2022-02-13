@extends('layouts.admin')
@section('content')


    
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
                <h4 class="card-title">Show All Vacation Leaves List</h4>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Vacation Leave
                  </button>
               

                 
              </div>
              
              <div class="card-content">
                  
                  <div class="card-body card-dashboard">
                      <p class="card-text">Vacation Leaves List</p>
                      
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                    <th>#id</th>
                                    <th>Employee Name</th>
                                    <th>Title</th>
                                    <th>Holiday Date start</th>
                                    <th>Holiday Date end</th>
                                    <th>Holiday Days</th>
                                    <th>Desc</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                  
                                @endphp
                                 @foreach($view_vacation_leave as $list)
                                
                                   <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$list->first_name}}</td>
                                     <td>{{$list->title}}</td>
                                     <td>{{$list->leave_date}}</td>
                                     <td>2</td>
                                     <td>{{$list->description}}</td>
                                     <td>
                                      @if($list->status == 1)
                                      <span class="text-success">Approved</span>
                                      @else
                                      <span class="text-danger">Pending</span>

                                      @endif
                                     </td>
                                       <td>
                                        <div class="row"> 
                                        @if($list->status != 0)
                                         
                                        
                                          @else
                                          <div class="col-6">                 
                                           <a class="btn btn-success btn-sm text-white"
                                             href="{{url('admin/vacation_status_active', $list->id)}}">Approve</a>   
                                         </div> 
                                         @endif 
                                         {{-- <div class="col-2">                 
                                            <a class="btn btn-primary btn-sm text-white"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}">Edit</a> 
                                        </div> --}}
                                         <div class="col-6">                 
                                            <a class="btn btn-danger btn-sm text-white"
                                            href="{{url('admin/delete_vacation', $list->id)}}">Delete</a> 
                                        </div>
                                       

                                        </div>
                                       </td>
                                   </tr>

                                   <div class="modal fade" id="exampleModalCenter{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Update Department</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('admin/edit_department')}}/{{$list->id}}" method="post">
                                                @csrf
                                              <div class="form-group">
                                                <label for="first-name-icon">Department Name</label>
                                                <div class="position-relative has-icon-left">
                                                  <input type="text" name="department_name" value="" class="form-control  @error('department_name') is-invalid @enderror"  >
                                                  @error('department_name')
                                                  <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                                </div>
                                
                                              
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit"  class="btn btn-primary">Add Department</button>
                                        </div>
                                    </form>
                                
                                      </div>
                                    </div>
                                  </div>
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
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add vacation Leave</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-material mx-2" method="POST"
          action="{{ url('admin/insert_vacation_leave') }}" >
          @csrf
              <div class="form-group">
                <label for="first-name-icon">Employee Name</label>
                <div class="position-relative has-icon-left">
                  <select name="user_id" class="form-control ">
                    <option value="">Select Employee</option>
                    @foreach($all_emp as $list)
                    <option value="{{$list->id}}">{{$list->first_name}}</option>
                    @endforeach
                  </select>
                  <div class="form-control-position">
                    <i class="feather icon-user"></i>
                </div>
                </div>
                <div class="form-group">
                  <label for="first-name-icon">Title</label>
                  <div class="position-relative has-icon-left">
                      <input type="text" id="first-name-icon" class="form-control" name="title"
                          placeholder="Title" value="" required="">
                      <div class="form-control-position">
                          <i class="feather icon-user"></i>
                      </div>
                  </div>
              </div>
                <div class="form-group">
                  <label for="first-name-icon">Leave Date Start</label>
                  <div class="position-relative has-icon-left">
                      <input type="date" id="first-name-icon" class="form-control" name="leave_date_start"
                          placeholder="Leave Date" value="" required="">
                      <div class="form-control-position">
                          <i class="feather icon-user"></i>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="first-name-icon">Leave Date End</label>
                <div class="position-relative has-icon-left">
                    <input type="date" id="first-name-icon" class="form-control" name="leave_date_end"
                        placeholder="Leave Date" value="" required="">
                    <div class="form-control-position">
                        <i class="feather icon-user"></i>
                    </div>
                </div>
            </div>
              <div class="form-group">
                <label for="first-name-icon">Description</label>
                <div class="position-relative has-icon-left">
        
                        <textarea cols="4" rows="4" name="description" class="form-control"></textarea>
                    <div class="form-control-position">
                        <i class="feather icon-user"></i>
                    </div>
                </div>
            </div>
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Add Vacation Leave</button>
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection
