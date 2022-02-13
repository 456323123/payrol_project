@extends('layouts.admin')
@section('title','Employee Edit')
@section('heading','Employee Edit')

@section('content')
{{-- <div class="col-md-4 col-12 mb-1">
<fieldset>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">$</span>
</div>
<input type="text" class="form-control" placeholder="Addon On Both Side" aria-label="Amount (to the nearest dollar)">
<div class="input-group-append">
<span class="input-group-text">.00</span>
</div>
</div>
</fieldset>
</div> --}}
<section id="justified-pills">
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edit</h4>
</div>

<div class="card-content">
<div class="card-body">
@if(Session::has('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
</div>
@endif
<ul class="nav nav-pills nav-justified">
<li class="nav-item">
<a class="nav-link active" id="home-tab-justified" data-toggle="pill" href="#home-justified" aria-expanded="true">Basic info</a>
</li>
<li class="nav-item">
<a class="nav-link " id="ID-tab-justified" data-toggle="pill" href="#ID" aria-expanded="false">ID</a>
</li>
<li class="nav-item">
<a class="nav-link " id="profile-tab-justified" data-toggle="pill" href="#profile-justified" aria-expanded="false">Contact</a>
</li>

<li class="nav-item">
<a class="nav-link" id="about-tab-justified" data-toggle="pill" href="#about-justified" aria-expanded="false">About</a>
</li>
</ul>
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="home-justified" aria-labelledby="home-tab-justified" aria-expanded="true">
<form class="form form-vertical" method="POST" enctype="multipart/form-data" action="{{ route('admin.employeeUpdate', $emp->id) }}">
@csrf
<input type="hidden" name="user_role" value="user">

<section id="basic-vertical-layouts">
<div class="row match-height">

<div class="col-md-12 col-12">
<div class="card">

<div class="card-content">
<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">First Name</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="first_name" placeholder="First Name" value="{{ $emp->first_name }}" required>
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
<input type="text" id="first-name-icon" class="form-control" name="last_name" placeholder="Last Name" value="{{ $emp->last_name }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="password-icon">Attn Inc Rate</label>
<div class="position-relative has-icon-left">
<input type="number" id="password-icon" class="form-control" name="attn_inc_rate" placeholder="Attn Inc Rate" max="80" value="{{ $emp->attn_inc_rate }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
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
<option value="male" @if($emp->gender === 'male') selected  @endif>Male</option>
<option value="female" @if($emp->gender === 'female') selected  @endif>Female</option>
</select>
<div class="form-control-position">
<i class="feather icon-users"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Email</label>
<div class="position-relative has-icon-left">
<input type="email" id="contact-info-icon" class="form-control" name="email" placeholder="Email" value="{{ $emp->email }}" required>
<div class="form-control-position">
<i class="feather icon-mail"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="password-icon">Date of Birth</label>
<div class="position-relative has-icon-left">
<input type="date" id="password-icon" class="form-control" name="dob" placeholder="DOB" value="{{ date('Y-m-d', strtotime($emp->dob)) }}">
<div class="form-control-position">
<i class="feather icon-gift"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Address</label>
<div class="position-relative has-icon-left">
<input type="text" id="contact-info-icon" class="form-control" name="residence_address" placeholder="Address" value="{{ $emp->residence_address }}" required>
<div class="form-control-position">
<i class="feather icon-map"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="password-icon">Employment Status</label>
<div class="position-relative has-icon-left">
<select name="employment_status" class="form-control" id="gender" required>
<option value="" disabled>Select Option</option>
<option value="Permanent" @if($emp->employment_status === 'Permanent') selected  @endif>Permanent </option>
<option value="Contract"  @if($emp->employment_status === 'Contract') selected  @endif>Contract </option>
</select><div class="form-control-position">
<i class="feather icon-briefcase"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="contact-info-icon">Hire Date</label>
<div class="position-relative has-icon-left">
<input type="date" id="contact-info-icon" class="form-control" name="hire_date" placeholder="Hire Date" value="{{ $emp->hire_date }}" required>
<div class="form-control-position">
<i class="feather icon-check"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="password-icon">Employee ID</label>
<div class="position-relative has-icon-left">
<input type="number" id="password-icon" class="form-control" name="employee_id" placeholder="Employee ID" value="{{ $emp->employee_id }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="password-icon">Regular Hours</label>
<div class="position-relative has-icon-left">
<input type="number" id="password-icon" class="form-control" name="regular_hours" placeholder="Regular Hours" value="{{ $emp->regular_hours }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="password-icon">Hourly Rate</label>
<div class="position-relative has-icon-left">
<input type="number" id="password-icon" class="form-control" name="hourly_rate" placeholder="Hourly Rate" value="{{ $emp->hourly_rate }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="password-icon">OT Rate</label>
<div class="position-relative has-icon-left">
<input type="number" id="password-icon" class="form-control" name="ot_rate" placeholder="OT Rate" value="{{ $emp->ot_rate }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
    <div class="form-group">
    <label for="password-icon">Department</label>
    <div class="position-relative has-icon-left">
    {{-- <input type="number" id="password-icon" class="form-control" name="statutory_deductions" placeholder="Statutory Deductions" required> --}}
    <select name="department" class="form-control" id="gender" required>
    <option value="" disabled>Select Option</option>
    @php
        $depart=App\Models\Department::where('status',1)->get();
    @endphp
    @foreach($depart as $list)

    <option value="{{$list->id}}" @if ($list->id ==$emp->department) selected @endif>{{$list->department}}</option>
        @endforeach
</select>
    <div class="form-control-position">
    <i class="feather icon-user"></i>
    </div>
    </div>
    </div>
    </div>

<div class="col-6">
<div class="form-group">
<label for="password-icon">Statutory Deductions</label>
<div class="position-relative has-icon-left">
{{-- <input type="number" id="password-icon" class="form-control" name="statutory_deductions" placeholder="Statutory Deductions" value="{{ $emp->statutory_deductions }}" required> --}}
<select name="statutory_deductions" class="form-control" id="gender" required>
<option value="" disabled>Select Option</option>
<option value="applicable" @if($emp->statutory_deductions === 'applicable') selected  @endif>Applicable</option>
<option value="not applicable" @if($emp->statutory_deductions === 'not applicable') selected  @endif>Not Applicable</option>
</select>


<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="email-id-icon">Photo</label>
  <input type="file"  name="photo" class="form-control dropify" data-default-file="{{asset('uploads/employees/'.$emp->photo)}}">
</div>
</div>


{{-- <div class="col-6">
<div class="form-group">
<label for="password-icon">Password</label>
<div class="position-relative has-icon-left">
<input type="password" id="password" value="" class="form-control" name="password" placeholder="Password" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div> --}}
{{--
<div class="col-6">
<div class="form-group">
<a class="btn btn-info my-2 text-white" onclick="generate_password()">Generate</a>
</div>
</div> --}}


</div>
</div>

</div>
</div>
</div>
</div>
</div>
</section>


</div>


<div class="tab-pane " id="ID" role="tabpanel" aria-labelledby="ID" aria-expanded="false">
<section id="basic-vertical-layouts">
<div class="row match-height">

<div class="col-md-12 col-12">
<div class="card">

<div class="card-content">
<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">ID Type</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="id_type" value="{{ $emp->id_type }}" placeholder="ID Type" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">ID Number</label>
<div class="position-relative has-icon-left">
<input type="number" id="first-name-icon" class="form-control" name="id_number" value="{{ $emp->id_number }}" placeholder="ID Number" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Bank</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="bank" value="{{ $emp->bank }}" placeholder="Bank" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Account Number</label>
<div class="position-relative has-icon-left">
<input type="number" id="first-name-icon" class="form-control" name="account_number" value="{{ $emp->account_number }}" placeholder="Account Number" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Branch</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="branch" value="{{ $emp->branch }}" placeholder="Branch" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>

<div class="col-6">
<div class="form-group">
<label for="first-name-icon">TRN</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon"  pattern="\d{9}|\d{9}"  title="Must be only 9 digit" class="form-control" name="trn" value="{{ $emp->trn }}" placeholder="TRN" required>

<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">NIS</label>
<div class="position-relative has-icon-left">
<input type="number" id="first-name-icon" class="form-control" name="nis" value="{{ $emp->nis }}" placeholder="NIS" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
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
</div>


<div class="tab-pane " id="profile-justified" role="tabpanel" aria-labelledby="profile-tab-justified" aria-expanded="false">
<section id="basic-vertical-layouts">
<div class="row match-height">

<div class="col-md-12 col-12">
<div class="card">

<div class="card-content">
<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Phone Number</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="phone_number" value="{{ $emp->phone_number }}" placeholder="Phone Number" required>
<div class="form-control-position">
<i class="feather icon-smartphone"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Emergency Contact Name</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="emergency_contact_name" value="{{ $emp->emergency_contact_name }}" placeholder="Emergency Contact Name" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Emergency Contact Number</label>
<div class="position-relative has-icon-left">
<input type="number" id="first-name-icon" class="form-control"  name="emergency_contact_number" value="{{ $emp->emergency_contact_number }}" placeholder="Emergency Contact Number" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
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
</div>

<div class="tab-pane" id="about-justified" role="tabpanel" aria-labelledby="about-tab-justified" aria-expanded="false">
<section id="basic-vertical-layouts">
<div class="row match-height">

<div class="col-md-12 col-12">
<div class="card">

<div class="card-content">
<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Education</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="education" value="{{ $emp->education }}" placeholder="Education" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
</div>
<div class="col-6">
<div class="form-group">
<label for="first-name-icon">Experience</label>
<div class="position-relative has-icon-left">
<input type="text" id="first-name-icon" class="form-control" name="experience" placeholder="Experience" value="{{ $emp->experience }}" required>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
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
</div>
<div class="col-12">
<button type="submit" class="btn btn-primary mr-1 ">Submit</button>
<button type="reset" class="btn btn-outline-warning mr-1 ">Reset</button>
</div>
</div>

</div>

</div>

</div>

</div>

</div>

</form>
</section>

<script>
function generateP() {
var pass = '';
var upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var lower = 'abcdefghijklmnopqrstuvwxyz';
var numbers = '0123456789';
var specialChars = '!@#$%^&*()\\-_=+{};:,<.>';

var str1 = upper + lower + numbers + specialChars;

for (i = 1; i <= 8; i++) {
var char = Math.floor(Math.random()
* str1.length + 1);

pass += str1.charAt(char)
}

let firstLetter = Math.floor(Math.random()
* upper.length + 1);

return upper.charAt(firstLetter) + pass;
}


function generate_password() {
let password = generateP();
$('#password').val(password);
}
</script>

@endsection

