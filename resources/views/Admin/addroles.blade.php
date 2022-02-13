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
                <h4 class="card-title">Show All Roles List</h4>

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                   <i class="feather icon-plus" title="Add Role"> </i>Add Role 
                  </button>
               

                 
              </div>
              
              <div class="card-content">
                  
                  <div class="card-body card-dashboard">
                      <p class="card-text">Role List</p>
                      
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
                                 @foreach($roles as $list)
                                 @php
                                 $user_name=Auth::user()->first_name;
                             @endphp
                                   <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$list->name}}</td>
                                       <td>

                                         
                                       
                                         
               
                                            <a class="btn btn-primary btn-sm text-white"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}">Edit</a> 
                
                                            <a class="btn btn-danger btn-sm text-white"
                                            href="{{route('admin.delete_department', $list->id)}}">Delete</a> 
                                       

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
                                            <form action="{{url('admin/update/roles')}}/{{$list->id}}" method="post">
                                                @csrf
                                              <div class="form-group">
                                                <label for="first-name-icon">Role Name</label>
                                                <div class="position-relative has-icon-left">
                                                  <input type="text" name="role_name_update"  value="{{ $list->name }}"  class="form-control select"  class="form-control  @error('department_name') is-invalid @enderror"  >
                                                        

                                                </div>
                                
                                              
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit"  class="btn btn-primary">Update Role</button>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/add/roles')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Role Name</label>
                <div class="position-relative has-icon-left">
                  <input type="text" name="role_name" class="form-control"  required >
               
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