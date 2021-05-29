@extends('layouts.adminDashboard')

@section('content')
    @if(session('paymentSuccessMessage'))
        <div class="alert alert-success" >
            {{session('paymentSuccessMessage')}}
            @endif
        </div>
            <div class="card-header">
                <h3 class="card-title">Vehicle List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>driver</th>
                            <th>phone</th>
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
                        while ($a<count($vehicles)){  ?>
                        <tr>
                            <td>{{$vehicles[$a]->vid}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->fname)." ".\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->lname)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->phone)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->model_name)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->model_number)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->model_year)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->color)}}</td>
                            <td>{{$vehicles[$a]->plate_number}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicles[$a]->manufacture)}}</td>
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
