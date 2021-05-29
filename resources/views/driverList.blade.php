@extends('layouts.adminDashboard')

@section('content')

    @if(session('deletePersonnelMSG'))
        <div class="alert alert-success" >
            {{session('deletePersonnelMSG')}}
            @endif
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Driver List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>FullName</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a=0;
                        while ($a<count($driverInfo)){  ?>
                        <tr>
                            <td>{{$driverInfo[$a]->id}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[$a]->fname).' '.\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[$a]->lname)}}</td>
                            <td>{{$driverInfo[$a]->username}}</td>
                            <td>{{$driverInfo[$a]->email}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[$a]->phone)}}</td>
                            <td><a href="{{route('showEditDriver',$driverInfo[$a]->id)}}" class="btn btn-outline-primary"><span class="fa fa-edit" style="color: blue"></span></a></td>
                            <td>
                                <form action="{{route('deletePersonnel')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="driverID" value="{{$driverInfo[$a]->id}}">
                                    <input type="hidden" name="userID" value="{{$driverInfo[$a]->UID}}">
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
