@extends('layouts.admin')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Year Picker CSS -->
<link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />

<!-- Year Picker Js -->
<script src="{{asset('js/yearpicker.js')}}"></script>
    <section id="basic-datatable">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Threshold
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form class="my-5" method="post" action="{{url('admin/add_threshold')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="first-name-icon">Year</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="number" class="form-control" name="year" placeholder="YYYY" min="2021" max="2050">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-calendar "></i>
                                                    </div>
                                                    @error('year')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">Cycle/Threshold</label>

                                                <div class="position-relative has-icon-left">
                                                    <select type="text" list="browsers" id="first-name-icon"
                                                        class="form-control" name="cycle" placeholder="Cycle"
                                                        required="">

                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Fortnightly">Fortnightly</option>
                                                        <option value="Monthly">Monthly</option>
                                                </select>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    @error('cycle')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">Pay</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control"
                                                                name="amount" placeholder="Amount">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-money"></i>
                                                            </div>
                                                            @error('amount')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">Days</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control"
                                                                name="days" placeholder="Days">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-calendar "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">Paid By / Calculated By</label>

                                                <div class="position-relative has-icon-left">
                                                    <select type="text" list="Paid" id="first-name-icon"
                                                        class="form-control" name="paid_by" placeholder="Cycle"
                                                        required="">

                                                        <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                        <option value="Task">Task</option>
                                                    </select>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    @error('paid_by')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="btn-group pull-left">
                                                <button type="reset" class="btn btn-warning pull-right">Reset</button>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                                            </div>


                                        </form>
                                        <br>
                                       

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    @endsection
