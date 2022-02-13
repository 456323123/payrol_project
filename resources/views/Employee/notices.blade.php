@extends('Employee.layouts.main')
@section('content')
    <?php
    use Carbon\Carbon;
    use App\Models\Attendence;
    use  App\Models\Notice;
    $notice=Notice::get();
    $todayDate = Carbon::now()->format('d-m-Y');

    ?>
        
   <div class="row">
       @foreach($notice as $data)
       @php 
               $total_time_seconds = Carbon::parse($data->start_time)->diffInDays($data->end_date);
               $total_time_seconds = Carbon::parse($data->start_time)->diffInDays($todayDate);
       @endphp
           @if($data->start_date<$data->end_date)

                            <div class="col-md-3">
                            <div class="card-deck-wrapper">
                                <div class="card-deck">
                                    <div class="card">
                                        <div class="card-content">

                                            <div class="card-body">
                                                <h4 class="card-title">{{ $data->title }}</h4>
                                                {{--  <p class="card-text">This card has supporting text below as a natural lead-in to
                                                    additional content.</p>  --}}
                                                <p class="card-text"><small class="text-muted">Expridate {{ $data->end_date }}</small>   
<button class="btn btn-primary btn-sm  float-right  " href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter{{$data->id}}" style="font-size: 15px;">show</button>

                                                </p>
                                           
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                        </div>
                    </div>

                    
                                   <div class="modal fade" id="exampleModalCenter{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog " role="document" style="max-width: 70%;">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Show Notice Detail</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                             <form action="{{url('admin/edit/notices')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon"><h4>Title {{ $data->title }}</h4> </label> 
            </div>

   <div class="form-group">
                <label for="first-name-icon">Description </label>
                <div class="position-relative has-icon-left">
                                                                       {!! $data->description	!!}

                </div>

              
            </div>
             <div class="form-group">
                <label for="first-name-icon">Notice From Date <span>{{ $data->start_date }}</span></label>
              
            </div>  
            
            <div class="form-group">
                <label for="first-name-icon">Notice To Date   <span>{{ $data->end_date }}</span></label>

              
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Upadte</button>
        </div>
    </form>
                    @else

                    @endif
 @endforeach
  
                    
   </div>
       </div>

@endsection
