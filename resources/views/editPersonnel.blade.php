@extends('layouts.adminDashboard')

@section('content')

    @if(session('updateSuccessMSG'))
        <div class="alert alert-success">
            {{session('updateSuccessMSG')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Personnel Form</h3>
        </div>
        <form role="form"  action="{{route('UpdatePersonnel')}}" method="post">
            @csrf
            <input type="hidden" name="personnelID" value="{{$data[0]->profile_id}}">
            <input type="hidden" name="userID" value="{{$data[0]->uid}}">
            <div class="card-body bg-white" >
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control"  placeholder="Write Firstname" value="{{$data[0]->fname}}" name="fname">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Second Name</label>
                    <input type="text" class="form-control"  placeholder="Write Second Name" value="{{$data[0]->lname}}" name="lname">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control"  placeholder="Write Username" value="{{$data[0]->username}}" name="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Write Email" value="{{$data[0]->email}}" name="email" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="text" class="form-control"  placeholder="Write Phone Number" value="{{$data[0]->phone}}" name="phone">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
