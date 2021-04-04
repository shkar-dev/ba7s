@extends('layouts.adminDashboard')

@section('content')

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
                        <td>{{$personnels[$a]->fname.' '.$personnels[$a]->lname}}</td>
                        <td>{{$personnels[$a]->username}}</td>
                        <td>{{$personnels[$a]->email}}</td>
                        <td>{{$personnels[$a]->phone}}</td>
                        <td><span class="fa fa-edit" style="color: blue"></span></td>
                        <td><span class="fa fa-trash" style="color: red"></span></td>
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
