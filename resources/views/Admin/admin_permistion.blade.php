@extends('layouts.admin')
@section('content')

    <form class="form form-vertical" method="POST" enctype="multipart/form-data" action="{{ route('permission.update',$user->id) }}">
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
<input type="text" id="first-name-icon" class="form-control"  value="{{ $user->first_name }}" name="first_name" placeholder="First Name" required>
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
<input type="text" id="first-name-icon" class="form-control"  value="{{ $user->last_name }}" name="last_name" placeholder="Last Name" required>
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
<input type="email" id="contact-info-icon" class="form-control" value="{{ $user->email }}" name="email" placeholder="Email" required>
<div class="form-control-position">
<i class="feather icon-mail"></i>
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
<input type="text" id="first-name-icon" class="form-control"  value="{{ $user->user_password }}" name="password" placeholder="Last Name" required>
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
                                                    <option value="{{ $value->name }}"  @if($value->name==$user->user_role) selected @endif>{{$value->name   }}</option>
                                                      
                                                     
                                                    @endforeach
                                                    @else
                                                 @foreach($simple as  $value) 
                                                    <option value="{{ $value->name }}"  @if($value->name==$user->user_role) selected @endif>{{$value->name   }}</option>
                                                      
                                                     
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
<div class="position-relative has-icon-left">
<label for="email-id-icon">Photo</label>
  <input type="file"  name="photo" class="form-control dropify" data-default-file="{{asset('uploads/employees/'.$user->photo)}}">
</div><div class="form-control-position">
</div>
</div>
</div>

<div class="col-md-6 col-6">
  @if(!empty($adminroles))
  @foreach($adminroles as $role )
    @if($role['module']=="employes")
     @if($role['view_access']=='1')
        @php $viewEmployes="checked";  @endphp
        @else
           @php $viewEmployes="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editEmployes="checked";  @endphp
        @else
           @php $editEmployes="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullEmployes="checked";  @endphp
        @else
           @php $fullEmployes="";  @endphp
@endif
     @endif
  @endforeach
  @endif


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
                                                                          <input type="checkbox" @if(isset($viewEmployes)) {{ $viewEmployes }} @endif id="users-checkbox1" value="1" name="employes[view]"  class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" @if(isset($editEmployes)) {{ $editEmployes }} @endif value="1" name="employes[edit]" id="users-checkbox2" class="custom-control-input"><label class="custom-control-label" for="users-checkbox2"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control  custom-checkbox">
                                                                          <input type="checkbox" @if(isset($fullEmployes)) {{ $fullEmployes }} @endif id="users-checkbox3" value="1" name="employes[full]"  class="custom-control-input"><label class="custom-control-label" for="users-checkbox3"></label>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                </tr>
             @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="attendance")
     @if($role['view_access']=='1')
        @php $viewattendance="checked";  @endphp
        @else
           @php $viewattendance="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editattendance="checked";  @endphp
        @else
           @php $editattendance="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullattendance="checked";  @endphp
        @else
           @php $fullattendance="";  @endphp
@endif


     @endif
@endforeach
  @endif



                                                                <tr>
                                                                    <td>Attendance</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          
                                                                          <input type="checkbox" id="users-checkbox5" @if(isset($viewattendance)) {{ $viewattendance }} @endif value="1" name="attendance[view]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox5"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox6" @if(isset($editattendance)) {{ $editattendance }} @endif value="1" name="attendance[edit]" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox6"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox7"  @if(isset($fullattendance)) {{ $fullattendance }} @endif value="1" name="attendance[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox7"></label>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                </tr>
                                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="department")
     @if($role['view_access']=='1')
        @php $viewdepartment="checked";  @endphp
        @else
           @php $viewdepartment="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editdepartment="checked";  @endphp
        @else
           @php $editdepartment="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fulldepartment="checked";  @endphp
        @else
           @php $fulldepartment="";  @endphp
@endif


     @endif
@endforeach
  @endif
                                                                <tr>
                                                                    <td>Department</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox9" @if(isset($viewdepartment)) {{ $viewdepartment }} @endif class="custom-control-input" value="1" name="department[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox9"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox"   @if(isset($editdepartment)) {{ $editdepartment }} @endif value="1" name="department[edit]" id="users-checkbox10" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox10"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox11"  @if(isset($fulldepartment)) {{ $fulldepartment }} @endif value="1" name="department[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox11"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>

                                                             @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="payrol")
     @if($role['view_access']=='1')
        @php $viewpayroll="checked";  @endphp
        @else
           @php $viewpayroll="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editpayroll="checked";  @endphp
        @else
           @php $editpayroll="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullpayroll="checked";  @endphp
        @else
           @php $fullpayroll="";  @endphp
@endif


     @endif
@endforeach
  @endif
                                                                     <tr>
                                                                <td>PayRol</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox13" @if(isset($viewpayroll)) {{ $viewpayroll }} @endif class="custom-control-input" value="1" name="payrol[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox13"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editpayroll)) {{ $editpayroll }} @endif value="1" name="payrol[edit]" id="users-checkbox14" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox14"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                          <input type="checkbox" id="users-checkbox15"  @if(isset($fullpayroll)) {{ $fullpayroll }} @endif value="1" name="payrol[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox15"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>





{{--  ///thresold  --}}
                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="thresold")
     @if($role['view_access']=='1')
        @php $viewthresold="checked";  @endphp
        @else
           @php $viewthresold="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editthresold="checked";  @endphp
        @else
           @php $editthresold="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullthresold="checked";  @endphp
        @else
           @php $fullthresold="";  @endphp
@endif


     @endif
@endforeach
  @endif
                                                                     <tr>
                                                                <td>Threshold</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox16" @if(isset($viewthresold)) {{ $viewthresold }} @endif class="custom-control-input" value="1" name="thresold[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox16"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editthresold)) {{ $editthresold }} @endif value="1" name="thresold[edit]" id="users-checkbox17" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox17"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox18"  @if(isset($fullthresold)) {{ $fullthresold }} @endif value="1" name="thresold[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox18"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>


{{--  ///deduction  --}}
                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="deduction")
     @if($role['view_access']=='1')
        @php $viewdeduction="checked";  @endphp
        @else
           @php $viewdeduction="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editdeduction="checked";  @endphp
        @else
           @php $editdeduction="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fulldeduction="checked";  @endphp
        @else
           @php $fulldeduction="";  @endphp
@endif


     @endif
@endforeach
  @endif


                                                            <tr>
                                                                <td>Deduction</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox19" @if(isset($viewdeduction)) {{ $viewdeduction }} @endif class="custom-control-input" value="1" name="deduction[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox19"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editdeduction)) {{ $editdeduction }} @endif value="1" name="deduction[edit]" id="users-checkbox20" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox20"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox21"  @if(isset($fulldeduction)) {{ $fulldeduction }} @endif value="1" name="deduction[full]" class="custom-control-input"><label class="custom-control-label" for="users-checkbox21"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>





                                                                
{{--  ///bonus  --}}
                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="bonus")
     @if($role['view_access']=='1')
        @php $viewbonus="checked";  @endphp
        @else
           @php $viewbonus="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editbonus="checked";  @endphp
        @else
           @php $editbonus="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullbonus="checked";  @endphp
        @else
           @php $fullbonus="";  @endphp
@endif


     @endif
@endforeach
  @endif


                                                            <tr>
                                                                <td>Bonus</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox22" @if(isset($viewbonus)) {{ $viewbonus }} @endif class="custom-control-input" value="1" name="bonus[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox22"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editbonus)) {{ $editbonus }} @endif value="1" name="bonus[edit]" id="users-checkbox23" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox23"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox24"  @if(isset($fullbonus)) {{ $fullbonus }} @endif value="1" name="bonus[full]" class="custom-control-input">
                                                     <label class="custom-control-label" for="users-checkbox24"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>






                                                                
                                                                
{{--  ///holidays  --}}
                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="holidays")
     @if($role['view_access']=='1')
        @php $viewholidays="checked";  @endphp
        @else
           @php $viewholidays="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editholidays="checked";  @endphp
        @else
           @php $editholidays="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullholidays="checked";  @endphp
        @else
           @php $fullholidays="";  @endphp
@endif


     @endif
@endforeach
  @endif


                                                            <tr>
                                                                <td>Vocations</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox25" @if(isset($viewholidays)) {{ $viewholidays }} @endif 
                            class="custom-control-input" value="1" name="holidays[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox25"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editholidays)) {{ $editholidays }} @endif value="1"
                                         name="holidays[edit]" id="users-checkbox26" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox26"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox27"  @if(isset($fullholidays)) {{ $fullholidays }} @endif 
                                                     value="1" name="holidays[full]" class="custom-control-input">
                                                     <label class="custom-control-label" for="users-checkbox27"></label>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>




                                                                
                                                                
                                                                
{{--  ///notices  --}}
                                                     @if(!empty($adminroles))
  @foreach($adminroles as $role )
           @if($role['module']=="notices")
     @if($role['view_access']=='1')
        @php $viewnotices="checked";  @endphp
        @else
           @php $viewnotices="";  @endphp
@endif

@if($role['edit_access']=='1')
        @php $editnotices="checked";  @endphp
        @else
           @php $editnotices="";  @endphp
@endif


@if($role['full_access']=='1')
        @php $fullnotices="checked";  @endphp
        @else
           @php $fullnotices="";  @endphp
@endif


     @endif
@endforeach
  @endif


                                                            <tr>
                                                                <td>Notices</td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="users-checkbox29" @if(isset($viewnotices)) {{ $viewnotices }} @endif 
                            class="custom-control-input" value="1" name="notices[view]" >
                                                                            <label class="custom-control-label" for="users-checkbox29"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox"   @if(isset($editnotices)) {{ $editnotices }} @endif value="1"
                                         name="notices[edit]" id="users-checkbox30" class="custom-control-input" >
                                                                            <label class="custom-control-label" for="users-checkbox30"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                     <input type="checkbox" id="users-checkbox31"  @if(isset($fullnotices)) {{ $fullnotices }} @endif 
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
                                                </div>
                                                </div>
                                              
                                            </div>

         
                                                
</form>
</div>
<!-- Button trigger modal -->

   </form>

      </div>
    </div>
  </div>
@endsection