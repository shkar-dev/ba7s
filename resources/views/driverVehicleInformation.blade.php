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
                <h3 class="card-title">Driver Vehicle Information</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>model name</th>
                            <th>model number</th>
                            <th>year</th>
                            <th>color</th>
                            <th>plate number</th>
                            <th>manufacture</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $a=0;
                        while ($a<count($data)){  ?>
                        <tr>
                            <td>{{$data[$a]->id}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->model_name)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->model_number)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->model_year)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->color)}}</td>
                            <td>{{$data[$a]->plate_number}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->manufacture)}}</td>

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
