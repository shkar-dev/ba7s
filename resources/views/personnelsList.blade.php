@extends('layouts.adminDashboard')

@section('content')

    @if(session('deletePersonnelMSG'))
        <div class="alert alert-success" >
            {{session('deletePersonnelMSG')}}
    @endif
        </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Personnel List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive bg-white" >
                <table class="table align-items-center">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="">FullName</th>
                        <th scope="">Username</th>
                        <th scope="">Email</th>
                        <th scope="">Phone</th>
                        <th scope="">Edit</th>
                        <th scope="">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $a=0;
                        while ($a<count($personnels)){  ?>
                    <tr>
                        <td>{{$personnels[$a]->id}}</td>
                        <td>{{\Illuminate\Support\Facades\Crypt::decryptString($personnels[$a]->fname).' '.\Illuminate\Support\Facades\Crypt::decryptString($personnels[$a]->lname)}}</td>
                        <td>{{$personnels[$a]->username}}</td>
                        <td>{{$personnels[$a]->email}}</td>
                        <td>{{\Illuminate\Support\Facades\Crypt::decryptString($personnels[$a]->phone)}}</td>
                        <td><a href="{{route('showEditPersonnel',$personnels[$a]->id)}}" class="btn btn-outline-primary"><span class="fa fa-edit" style="color: blue"></span></a></td>
                        <td>
                            <form action="{{route('deletePersonnel')}}" method="post">
                                @csrf
                                <input type="hidden" name="personnelID" value="{{$personnels[$a]->id}}">
                                <input type="hidden" name="userID" value="{{$personnels[$a]->uid}}">
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
