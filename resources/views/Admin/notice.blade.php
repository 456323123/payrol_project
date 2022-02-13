@extends('layouts.admin')
@section('content')

    
    <section id="basic-datatable">
    
  <div class="row">
      
      <div class="col-12">

        
        <div class="card">
                  
              <div class="card-header">
                <h4 class="card-title">Show All Notice Board List</h4>
                          @if($Employepermision['full_access']==1 )

                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">
                   <i class="feather icon-plus" title="Add Notice"> </i>Add Notice 
                  </button>
               
@endif
                 
              </div>
              
              <div class="card-content">
                  <div class="card-body card-dashboard">                      
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                    <th>#id</th>
                                    <th>Title Name</th>
                                      <th>Show Notice From	</th>
                           <th>Show Notice To	</th>
                            @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                           <th>ACtion	</th>
@endif
                                  </tr>
                              </thead>
                              <tbody>
                                 @php
                                    $i=1;
                                  
                                @endphp
                                 @foreach($notice as $list)
                                
                                   <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$list->title}}</td>
                                                                          <td>{{$list->start_date}}</td>
                                                                          <td>{{$list->end_date}}</td>
                                                @if($Employepermision['edit_access']==1 || $Employepermision['full_access']==1 )

                                       <td>
                                        <div class="row"> 
                                         <div class="col-2">                 
                                            <a class="btn btn-primary btn-sm text-white"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter{{$list->id}}"><i class="feather icon-edit" title="Edit"></i></a> 
                                        </div>
                                        @endif
                      @if($Employepermision['full_access']==1 )

                                         <div class="col-2">  
                       <a class=" alert-confirm btn btn-danger btn-sm text-white"
  onclick="deleteAlert('{{url('admin/notice',$list->id)}}')" title="delte" ><i class="feather icon-trash" title="Delte"></i></a>
               
                                        </div>
                                      
                                        </div>
                                       </td>
                                       @endif
                                   </tr>

                                   <div class="modal fade" id="exampleModalCenter{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog " role="document" style="max-width: 70%;">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Update Department</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                             <form action="{{url('admin/edit/notices')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Title </label>
                <div class="position-relative has-icon-left">
                  <input type="text" name="title" value="{{ $list->title }}" class="form-control"  >
                  <input type="hidden" name="id" value="{{ $list->id }}">
                  @error('department_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              
            </div>

   <div class="form-group">
                <label for="first-name-icon">Description </label>
                <div class="position-relative has-icon-left">
               <textarea type="text"  name="desciption[]" required class="form-control summernote" placeholder="write service description"  name="description"   data-validation-required-message="This email field is required">
            {!! $list->description	!!}
      </textarea>
                </div>

              
            </div>
             <div class="form-group">
                <label for="first-name-icon">Notice From Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" value="{{ $list->start_date }}" name="from_date" class="form-control  "  >
                  
                </div>

              
            </div>  
            
            <div class="form-group">
                <label for="first-name-icon">Notice To Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" name="to_date" value="{{ $list->end_date }}" class="form-control  "  >
                  
                </div>

              
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Upadte</button>
        </div>
    </form> 
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
</div>
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document"  style="max-width:70%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Notice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/add/notices')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="first-name-icon">Title Name</label>
                <div class="position-relative has-icon-left">
                  <input type="text" name="title" class="form-control" required  >
                  
                </div>

              
            </div>

   <div class="form-group">
                <label for="first-name-icon">Description</label>
                <div class="position-relative has-icon-left">
               <textarea type="text"  name="content[]" required class="form-control summernote" > </textarea>
                </div>

              
            </div>
             <div class="form-group">
                <label for="first-name-icon">Notice From Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" name="from_date" class="form-control" required >
                  
                </div>

              
            </div>  
            
            <div class="form-group">
                <label for="first-name-icon">Notice To Date </label>
                <div class="position-relative has-icon-left">
                  <input type="date" name="to_date" class="form-control "  required>
                  
                </div>

              
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Save</button>
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection