@extends('layouts.adminDashboard')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Driver Form</h3>
        </div>
        <form role="form">
            <div class="card-body bg-white">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" class="form-control"  placeholder="Write Firstname">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" class="form-control"  placeholder="Write Lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control"  placeholder="Write Second Name" >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Write Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="text" class="form-control"  placeholder="Write Phone Number">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
