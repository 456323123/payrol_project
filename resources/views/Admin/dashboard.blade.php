@extends('layouts.admin')
@section('title','Dashboard')
@section('heading','Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-4 col-6">
            <div class="card">

                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-primary">78</h2>
                            <p class="text-primary">Total User</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-database text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-success">80</h2>
                            <p class="text-success">Total Company User</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-alert-octagon text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-primary">90</h2>
                            <p class="text-primary">Total Driver User</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-database text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{--  <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?inquiries=continue">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-info">34</h2>
                            <p class="text-info">Schedule Requests</p>
                        </div>
                        <div class="avatar bg-rgba-info p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-activity text-info font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?inquiries=active">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-success">{{$started_inquiries}}</h2>
                            <p class="text-success">Started Inquiries</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-check-circle text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?inquiries=rejected">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-danger">{{$reject_inquiries}}</h2>
                            <p class="text-danger">Reject Inquiries</p>
                        </div>
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-x-circle text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?inquiries=cancel">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-danger">{{$cancelled_inquiries}}</h2>
                            <p class="text-danger">Cancel Inquiries</p>
                        </div>
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-stop-circle text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?payment=true">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-success">{{$paid_inquiries}}</h2>
                            <p class="text-success">Paid Inquiries</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-check-square text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card">
                <a href="{{route('admin.student.inquiries')}}?payment=false">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-warning">{{$unpaid_inquiries}}</h2>
                            <p class="text-warning">Unpaid Inquiries</p>
                        </div>
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>  --}}
    </div>
    {{--  <div class="text-center mt-2">
        <h3>Financial Statistics</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-warning">{{$pending_payments}}</h2>
                            <p class="text-warning">Payments Pending</p>
                        </div>
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-sun text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-danger">{{$due_payments}}</h2>
                            <p class="text-danger">Payments Due</p>
                        </div>
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-sun text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-secondary">2</h2>
                            <p class="text-secondary">Monthly Sales</p>
                        </div>
                        <div class="avatar bg-rgba-secondary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-sun text-secondary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-primary">£665.00</h2>
                            <p class="text-primary">Monthly Sales Revenue</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-sun text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-success">0</h2>
                            <p class="text-success">Last Week Sales</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-watch text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-dark">Rs.5656.00</h2>
                            <p class="text-dark">Last Week Expenses</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-server text-dark font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-success">£665.00</h2>
                            <p class="text-success">Total Revenue</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-server text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <a href="#">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0 text-danger">Rs.106,979.00</h2>
                            <p class="text-danger">Total Expenses</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-server text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>  --}}
    {{--  <div class="card">
        <div class="card-body">
            <h4 class="text-center"> Recent Inquiries</h4>
            <div id="data-list-view" class="data-list-view-header">
                <!-- DataTable starts -->
                <div class="table-responsive">
                    <table class="table data-list-view">
                        <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Request Date</th>
                            <th>Inquiry</th>
                            <th>Status</th>
                            <th class="float-right pr-2">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rec_inquiries as $inquiry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $inquiry->user->name ?? 'N/A' }}</td>
                                <td class="product-name">{{ $inquiry->user->email ?? 'N/A' }}</td>
                                <td class="product-name">{{ $inquiry->user->phone ?? 'N/A' }}</td>
                                <td class="product-category">{{ date('d-m-Y',strtotime($inquiry->created_at)) ?? 'N/A' }}</td>
                                <td class="product-category text-capitalize">{{ $inquiry->study_type ?? 'N/A' }}</td>

                                <td>
                                    <div class="chip

                                             @if($inquiry->status=='rejected' || $inquiry->status=='cancel' ) chip-danger
                                             @elseif($inquiry->status=='pending' )chip-primary
                                             @else chip-success @endif
                                        ">
                                        <div class="chip-body">
                                            <div class="chip-text">{{ $inquiry->status }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-action text-right">
                                    <div class="btn-group">
                                        <a href="{{route('admin.student.inquiries.detail',[$inquiry->id,$inquiry->user->name])}}" class="btn btn-relief-primary" title="Detail">Detail</a>
                                        <button type="button" onclick="deleteAlert('{{route('admin.student.inquiries.delete',$inquiry->id)}}')" title="Trash" class="btn btn-relief-danger alert-confirm"><span>Delete</span></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  --}}
{{--  <ul>
<li>
  <label for="cc">Credit Card Number</label>
  <input id="cc" type="tel" name="ccnumber" placeholder="XXXX XXXX XXXX XXXX" pattern="\d{4} \d{4} \d{4} \d{4}" class="masked" title="Enter the 16 number credit card">
</li>
</ul>  --}}

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.dt-buttons.btn-group').css("display", "none");
        });
    </script>

@endsection

