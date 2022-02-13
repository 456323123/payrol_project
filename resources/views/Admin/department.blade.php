@extends('layouts.admin')
@section('content')

<div class="container"> 
    
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
                <h4 class="card-title">Show All Department List</h4>
                                                        @if($Employepermision['full_access']==1 )

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Department
                  </button>
               
@endif
                 
              </div>
              
              <div class="card-content">
                  
                  <div class="card-body card-dashboard">
                      <p class="card-text">Department List</p>
                      
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                    <th>#id</th>
                                    <th>Department Name</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                  
                                @endphp
                                 @foreach($view_department as $list)
                                 @php
                                 $user_name=Auth::user()->first_name;
                             @endphp
                                   <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$list->department}}</td>
                                       <td>
                                        <div class="row"> 
                                                                                  @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                        @if($list->status != 0)
                                         
                                         <div class="col-2">

                                           <a class="btn btn-warning btn-sm text-white"  
                                            href="{{ route('admin.depart_status_deactive', $list->id)}}">Deactive</a>   
                                          </div>
                                          @else
                                          <div class="col-2">                 
                                           <a class="btn btn-success btn-sm text-white"
                                             href="{{route('admin.depart_status_active', $list->id)}}">Active</a>   
                                         </div> 
                                         @endif 
                                         @endif
                                         <div class="col-2">  
                                       @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )
               
                                            <a class="btn btn-primary btn-sm text-white"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}">Edit</a> 
                                        @endif
                                          </div>
                                         <div class="col-2"> 
                                          @if($Employepermision['full_access']==1  )
                
                                            <a class="btn btn-danger btn-sm text-white"
                                            href="{{route('admin.delete_department', $list->id)}}">Delete</a> 
                                            @endif
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
                                                  <input type="text" name="department_name" value="{{$list->department}}" class="form-control  @error('department_name') is-invalid @enderror"  >
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
          <h5 class="modal-title" id="exampleModalLongTitle">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/add_department')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Department Name</label>
                <div class="position-relative has-icon-left">
                  <input type="text" name="department_name" class="form-control  @error('department_name') is-invalid @enderror"  >
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
@endsection