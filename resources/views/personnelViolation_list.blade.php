@extends('layouts.personnel')

@section('personnel_content')

    @if(session('deletePersonnelMSG'))
        <div class="alert alert-success" >
            {{session('deletePersonnelMSG')}}
            @endif
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Personnel Violation List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="">full name</th>
                            <th scope="">car</th>
                            <th scope="">type</th>
                            <th scope="">location</th>
                            <th scope="">date</th>
                            <th scope="">phone</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a=0;
                            while ($a<count($data)){?>

                            <tr>
                                <td>{{$data[$a]->DID}}</td>
                                <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->fname)." ".\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->lname)}}</td>
                                <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->model_name)." ".\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->model_year)}}</td>
                                <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->type)}}</td>
                                <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->location)}}</td>
                                <td>{{$data[$a]->vdate}}</td>
                                <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data[$a]->phone)}}</td>
                            </tr>


                                <?php
                            $a++;}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection
