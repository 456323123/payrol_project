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
                        <h4 class="card-title">Employee Profile</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="col-md-6 offset-md-3">
                                {{-- @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif --}}
                                <form class="form-horizontal form-material mx-2" method="POST"
                                    action="{{ url('update_profile') }}" enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        $first_name=Auth::user()->first_name;
                                        $last_name=Auth::user()->last_name;
                                        $photo=Auth::user()->photo;
                                    @endphp
                                    <div class="form-group">
                                        <label for="first-name-icon">First Name</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="first-name-icon" class="form-control" name="first_name"
                                                placeholder="First Name" value="{{$first_name}}" required="">
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-icon">Last Name</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="first-name-icon" class="form-control" name="last_name"
                                                placeholder="Last Name" value="{{$last_name}}" required="">
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-icon">Image</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="file" id="first-name-icon" class="form-control dropify"
                                                name="photo" data-default-file="{{asset('uploads/employees')}}/{{$photo}}" placeholder="photo" >
                                            <div class="form-control-position">
                                                <i class="feather icon-file"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-icon">Current Password</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" id="first-name-icon" class="form-control"
                                                name="c_password" placeholder="Password" required="">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-icon">New Password</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" id="first-name-icon" class="form-control"
                                                name="new_password" placeholder="Password" required="">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                            @if ($errors->has('new_password'))
                                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-icon">Confirm Password</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" id="first-name-icon" class="form-control"
                                                name="confirm_password" placeholder="Confirm Password" required="">
                                            <div class="form-control-position">
                                                <i class="feather icon-lock"></i>
                                            </div>
                                            @if ($errors->has('confirm_password'))
                                                <span
                                                    class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

   
@endsection
