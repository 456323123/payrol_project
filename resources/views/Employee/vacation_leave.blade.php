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
                        <h4 class="card-title">Vacation Leave</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="col-md-6 offset-md-3">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form class="form-horizontal form-material mx-2" method="POST"
                                    action="{{ url('employee/insert_vacation_leave') }}" >
                                    @csrf
                                 
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
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-icon">Leave Start Date</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" id="first-name-icon" class="form-control" name="leave_date_start"
                                                        placeholder="Leave Date" value="" required="">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-icon">Leave End Date</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" id="first-name-icon" class="form-control" name="leave_date_end"
                                                        placeholder="Leave Date" value="" required="">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                </div>
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
                                 
                    
                                
                               
                                    <button type="submit" class="btn btn-primary">Submit Leave</button>
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
