@extends('layouts.admin')
@section('title','Employee')
@section('heading','Employees')

@section('content')

               <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row border-bottom-dark pb-1">
                                            <div class="col-md-12">
                                                    @if($Employepermision['full_access']==1 )

                                                <div class="text-right">
                                                    <a href="{{ route('admin.employees.create') }}" class="btn btn-success">New</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Phone Number</th>
                                                            <th>Email Address</th>
                                                            <th>Photo</th>
                                                            <th>Regular Hours</th>
                                                            <th>Hourly Rate</th>
                                                            <th>OT Rate</th>
                                                            <th>Stat.Ded.</th>
                                                            <th>Attn.Inc.</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    @forelse($employees as $emp)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $emp->first_name }}</td>
                                                            <td>{{ $emp->last_name }}</td>
                                                            <td>{{ $emp->phone_number }}</td>
                                                            <td>{{ $emp->email }}</td>
                                                            <td><img src="{{ asset('uploads/employees/'.$emp->photo) }}" width="100"></td>
                                                            <td>{{ $emp->regular_hours }}</td>
                                                            <td>{{ $emp->hourly_rate }}</td>
                                                            <td>{{ $emp->ot_rate }}</td>
                                                            <td>{{ $emp->statutory_deductions }}</td>
                                                            <td>{{ $emp->attn_inc_rate }}</td>
                                                            <td>

                                                         <a href="{{ route('admin.employees.view', $emp->id) }}"><i class="feather   icon-eye " title="View Detail" ></i></a>
                                                @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                                                <a href="{{ route('admin.employees.edit', $emp->id) }}"><i class="feather icon-edit ml-0.5" title="Edit Detail"></i></a>
                                                                @endif
                                         @if($Employepermision['full_access']==1 )

                                                                <a href="{{ route('admin.employees.delete', $emp->id) }}"><i class="feather ml-0.5 icon-trash text-danger" title="Delete Detail"></i></a>
                                                         @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    @empty
                                                            <p>There is no record right now</p>
                                                    @endforelse
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @endsection

