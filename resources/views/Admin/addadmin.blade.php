@extends('layouts.admin')
@section('content')
@php  
use App\Models\Role;

              $simple=Role::where('name','!=','super admin')->get();
              $superadmin=Role::get();
              @endphp
    
    <section id="basic-datatable">
    
  <div class="row">
      
      <div class="col-12">

        
        <div class="card">
                  
              <div class="card-header">
                <h4 class="card-title">Show All Notice Board List</h4>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createnew">
                   <i class="feather icon-plus" title="Add Notice"> </i>Add Notice 
                  </button>
               

                 
              </div>
              
              <div class="card-content">
                  <div class="card-body card-dashboard">                      
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                    <th>#id</th>
                                    <th>Title Name</th>
                                      <th>Show Notice From	</th>
                           <th>Show Notice To	</th>
                           <th>ACtion	</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  @php
                                    $i=1;
                                  
                                @endphp
                                 @foreach($users as $list)
                                
                                   <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$list->first_name}} {{$list->last_name}}</td>
                                     
                                                                          <td>{{$list->email}}</td>
                                                                          <td>{{$list->user_role}}</td>
                                       
                        <td>

                            <a href="{{url('admin/permission',$list->id)}}" class="text-default btn btn-sm btn-danger mr-2"><i class="feather icon-lock" style="font-size: 15px;" title="Edit Permission"></i></a>

                          </td>
                                      
                                   </tr>

                                   {{-- <div class="modal fade" id="exampleModalCenter{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog " role="document" style="max-width: 70%;">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Update Department</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                             <form action="{{url('admin/edit/notices')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Title </label>
                <div class="position-relative has-icon-left">
                  <input type="text" name="title" value="{{ $list->title }}" class="form-control"  >
                  <input type="hidden" name="id" value="{{ $list->id }}">
                  @error('department_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              
            </div>

   <div class="form-group">
                <label for="first-name-icon">Description </label>
                <div class="position-relative has-icon-left">
               <textarea type="text"  name="desciption[]" required class="form-control summernote" placeholder="write service description"  name="description"   data-validation-required-message="This email field is required">
            {!! $list->description	!!}
      </textarea>
                </div>

              
            </div>
             <div class="form-group">
                <label for="first-name-icon">Notice From Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" value="{{ $list->start_date }}" name="from_date" class="form-control  "  >
                  
                </div>

              
            </div>  
            
            <div class="form-group">
                <label for="first-name-icon">Notice To Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" name="to_date" value="{{ $list->end_date }}" class="form-control  "  >
                  
                </div>

              
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Upadte</button>
        </div>
    </form>  --}}
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
  <div class="modal fade" id="createnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document"  style="max-width:70%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Notice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url(route('admin.create.user'))}}" method="post" enctype="multipart/form-data">
                @csrf
              


<section id="basic-vertical-layouts">
  
<div class="card">

<div class="row match-height">
  <div class="card-content">
<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">First Name</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control"   name="first_name" placeholder="First Name" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Last Name</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control"   name="last_name" placeholder="Last Name" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Roles</label>
<div class="position-relative has-icon-left">
  <select name="user_role" class="form-control"  >
                                                 @if(auth()->user()->user_role=="super admin")         

                                                    @foreach($superadmin as  $value) 
                                                    <option value="{{ $value->name }}">{{$value->name   }}</option>
                                                      
                                                     
                                                    @endforeach
                                                    @else
                                                 @foreach($simple as  $value) 
                                                    <option value="{{ $value->name }}"  >{{$value->name   }}</option>
                                                      
                                                     
                                                    @endforeach

@endif


    </select>
<div class="form-control-position">
<i class="feather icon-users"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Gender</label>
<div class="position-relative has-icon-left">
<select name="gender" class="form-control" id="gender" required>
<option value="" disabled>Select Option</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
<div class="form-control-position">
<i class="feather icon-users"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Password </label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control"   name="password" placeholder="Last Name" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Email</label>
<div class="position-relative has-icon-left">
<input type="email" id="contact-info-icon" class="form-control"  name="email" placeholder="Email" required>
<div class="form-control-position">
<i class="feather icon-mail"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<div class="position-relative has-icon-left">
<label for="email-id-icon">Photo</label>
  <input type="file"  name="photo" class="form-control dropify" >
</div><div class="form-control-position">
</div>
</div>
</div>

<div class="col-md-6 col-6">
 


                                                    <div class="table-responsive border rounded px-1 ">
                                                        <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Permission</h6>
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th>Module</th>
                                                                    <th>View Access</th>
                                                                    <th>View/edit Access</th>
                                                                    <th>Full Access</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Employes</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox"  id="users-checkbox1" value="1" name="employes[view]"  class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox"  value="1" name="employes[edit]" id="users-checkbox2" class="custom-control-input"><label class="custom-control-label" for="users-checkbox2"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control  custom-checkbox">
                                                                          <input type="checkbox"  id="users-checkbox3" value="1" name="employes[full]"  class="custom-control-input"><label class="custom-control-label" for="users-checkbox3"></label>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                </tr>
        



                                                                <tr>
                                                                    <td>Attendance</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          
                                                                          <input type="checkbox" id="users-checkbox5" value="1" name="attendance[view]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox5"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox6"  value="1" name="attendance[edit]" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox6"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox7"   value="1" name="attendance[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox7"></label>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                                <tr>
                                                                    <td>Department</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox9"  class="custom-control-input" value="1" name="department[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox9"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox"   value="1" name="department[edit]" id="users-checkbox10" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox10"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox11"   value="1" name="department[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox11"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>

                                                                     <tr>
                                                                <td>PayRol</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox13"  class="custom-control-input" value="1" name="payrol[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox13"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"    value="1" name="payrol[edit]" id="users-checkbox14" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox14"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox15"   value="1" name="payrol[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox15"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>



                                                                     <tr>
                                                                <td>Threshold</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox16" class="custom-control-input" value="1" name="thresold[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox16"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"  value="1" name="thresold[edit]" id="users-checkbox17" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox17"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox18"  value="1" name="thresold[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox18"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>



                                                            <tr>
                                                                <td>Deduction</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox19"  class="custom-control-input" value="1" name="deduction[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox19"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   value="1" name="deduction[edit]" id="users-checkbox20" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox20"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox21"   value="1" name="deduction[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox21"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>




                                                            <tr>
                                                                <td>Bonus</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox22" class="custom-control-input" value="1" name="bonus[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox22"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"    value="1" name="bonus[edit]" id="users-checkbox23" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox23"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox24"  value="1" name="bonus[full]" class="custom-control-input">
                                                     <label class="custom-control-label" for="users-checkbox24"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>



                                                            <tr>
                                                                <td>Holidays</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox25" 
                            class="custom-control-input" value="1" name="holidays[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox25"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"    value="1"
                                         name="holidays[edit]" id="users-checkbox26" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox26"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox27"   
                                                     value="1" name="holidays[full]" class="custom-control-input">
                                                     <label class="custom-control-label" for="users-checkbox27"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>






                                                            <tr>
                                                                <td>Notices</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox29" 
                            class="custom-control-input" value="1" name="notices[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox29"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"    value="1"
                                         name="notices[edit]" id="users-checkbox30" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox30"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox31"  
                                                     value="1" name="notices[full]" class="custom-control-input">
                                                     <label class="custom-control-label" for="users-checkbox31"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>






                                                            </tbody>
                                                        </table>
                                                    </div>
                                                        <div class="col-12 mb-2 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn   btn-primary glow  mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Save
                                                        Changes</button>
                                                    <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
                                                </div>
                                                </div>
                                              
                                            </div>

         
                                                
</div>
<!-- Button trigger modal -->


      </div>
    </div>
  </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Save</button>
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection