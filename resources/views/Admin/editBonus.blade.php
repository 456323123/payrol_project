@extends('layouts.admin')
@section('content')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  --}}
{{--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
<!-- Year Picker CSS -->
{{--  <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}" />  --}}

<!-- Year Picker Js -->
{{--  <script src="{{asset('js/yearpicker.js')}}"></script>  --}}
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bonus</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form class="my-5" method="get" action="{{url('admin/update_bonus')}}" >
                                            <div class="form-group">
                                                <label for="first-name-icon">Bonus</label>

                                                <div class="position-relative has-icon-left">
                                                    <input type="text" class="form-control" value={{ $bonusData->bonus }} name="bonus" placeholder="bonus" >
                                                </div>

                                            </div>
                                            <div class="form-group">

                                                <div class="position-relative has-icon-left">
                                                    <input type="hidden" class="form-control" value={{ $bonusData->user_id }} name="user_id">
                                                </div>

                                            </div>
                                            <div class="form-group">

                                                <div class="position-relative has-icon-left">
                                                    <input type="hidden" class="form-control" value={{ $bonusData->start_date }} name="start_date"  >
                                                </div>

                                            </div>
                                            <div class="form-group">

                                                <div class="position-relative has-icon-left">
                                                    <input type="hidden" class="form-control" value={{ $bonusData->end_date }} name="end_date" >
                                                </div>

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