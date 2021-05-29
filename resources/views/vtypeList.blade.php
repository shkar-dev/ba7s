@extends('layouts.adminDashboard')

@section('content')

    @if(session('deletePersonnelMSG'))
        <div class="alert alert-success" >
            {{session('deletePersonnelMSG')}}
            @endif
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Vehicle Type List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="">Vehicle Type</th>
                            <th scope="">Edit</th>
                            <th scope="">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a=0;
                        while ($a<count($vehicleType)){  ?>
                        <tr>
                            <td>{{$vehicleType[$a]->id}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($vehicleType[$a]->type_name)}}</td>
                            <td><a href="" class="btn btn-outline-primary"><span class="fa fa-edit" style="color: blue"></span></a></td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger"><span class="fa fa-trash" style="color: red"></span></button>
                                </form>
                            </td>
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
