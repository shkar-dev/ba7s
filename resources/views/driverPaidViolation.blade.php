@extends('layouts.driver')

@section('driver_content')

    @if(session('paymentSuccessMessage'))
        <div class="alert alert-success" >
            {{session('paymentSuccessMessage')}}
            @endif
        </div>

        {{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
        {{--            Launch demo modal--}}
        {{--        </button>--}}

        <!-- Modal -->




        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">My Paid Violation</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Type</th>
                            <th>location</th>
                            <th>model Name</th>
                            <th>plate number</th>
                            <th>Date</th>
                            <th> money</th>
                            <th>pay for violation</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a=0;
                        while ($a<count($data['driver'])){  ?>
                        <tr>
                            <input type="hidden" name="vid.<?php echo $data['driver'][$a]->id; ?>" value="{{$data['driver'][$a]->id}}" id="vid.<?php echo $data['driver'][$a]->id; ?>">
                            <td>{{$data['driver'][$a]->id}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->type)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->location)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->model_name). " ".\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->model_year)}}</td>
                            <td>{{$data['driver'][$a]->plate_number}}</td>
                            <td>{{$data['driver'][$a]->violation_date}}</td>
                            <td>${{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->money)}}</td>

                            <td><button type="button" class="btn btn-outline-success "    ><span class="fa fa-check-circle"></span></button></td>
                        </tr>
                        <?php       $a++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>





@endsection
