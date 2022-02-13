@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}

<!-- Year Picker Js -->
{{--  <script src="{{asset('js/yearpicker.js')}}"></script>  --}}
    {{-- <section id="basic-datatable">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Deductions
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form class="my-5" method="post" action="{{route('add.deduction')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="first-name-icon">Name</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="text" class="form-control" name="name" placeholder="name" min="2021" max="2050">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-calendar "></i>
                                                    </div>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">Select Type</label>

                                                <div class="position-relative has-icon-left">
                                                    <select type="text" list="browsers" id="first-name-icon"
                                                        class="form-control" name="type_value" placeholder="Select type value"
                                                        required="">

                                                        <option value="">select type value</option>
                                                        <option value="doller">$</option>
                                                        <option value="percentage">%</option>
                                                </select>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">value percentage</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control"
                                                                name="percentage" placeholder="percentage">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-money"></i>
                                                            </div>
                                                            @error('percentage')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password-icon">NIS FIX Value Percentage</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control"
                                                                name="Nis" placeholder="Nis">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-calendar "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-icon">value</label>

                                                <div class="position-relative has-icon-left">
                                                    <select type="text" list="Paid" id="first-name-icon"
                                                        class="form-control" name="type" placeholder="selelct type"
                                                        required="">

                                                        <option  value="" >select type</option>
                                                        <option value="employe_decduction">Employe decduction</option>
                                                        <option value="employe_contribition">Employe contribition</option>
                                                    </select>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    @error('type')
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
        </section> --}}



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
                            <h4 class="card-title">Deduction/Contribution List</h4>
                    @if($Employepermision['full_access']==1 )

                            <a href="{{url('admin/add_deduction')}}" class="btn btn-primary float-right">
                              Add
                            </a>
                            @endif
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <p class="card-text">Threshold List</p>
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Deduction</th>
                                                <th>Percentage/Dollar</th>
                                                <th>Type</th>
                                                                    @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                         @foreach($get_deduction as $list)
                                         <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$list->name}}</td>
                                          <td>{{$list->nis_fix_value}}</td>
                                          <td>{{$list->percentage_value}}</td>
                                          <td>{{$list->type_deduction}}</td>
                             @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                          <td>
                                              <a href="{{url('admin/edit_deduction')}}/{{$list->id}}" class="text-primary mr-2"><i class="feather icon-edit" title="Edit"></i></a>
                                              {{-- <a href="{{url('admin/delete_threshold')}}/{{$list->id}}" class="text-danger"><i class="feather icon-trash " title="Delete"></i></a> --}}
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

    @endsection
