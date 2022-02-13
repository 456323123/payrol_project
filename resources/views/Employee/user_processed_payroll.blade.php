@extends('Employee.layouts.main')
@section('content')
    <?php
    use Carbon\Carbon;
    use App\Models\Attendence;

    ?>
    <div class="card">
        <div class="card-header">
          <h4 class="card-title">Show All Department List</h4>
        </div>
    
    
        <div class="card-content">
            <div class="card-body card-dashboard">
                <p class="card-text">Department List</p>
                <div class="table-responsive">
                    <table class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Pay</th>
                                <th>NIS</th>
                                <th>Income Tax</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($user_processed_payroll as $process)
                        <tr>
                            <td>{{$process->user_id}}</td>
                            <td>{{$process->start_date}}</td>
                            <td>{{$process->end_date}}</td>
                            <td>{{$process->total_pay}}</td>
                            <th>{{$process->nis}}</th>
                            <th>{{$process->income}}</th>
                        </tr>
                        @endforeach
@endsection
