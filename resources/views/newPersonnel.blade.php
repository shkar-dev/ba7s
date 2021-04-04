@extends('layouts.adminDashboard')

@section('content')
    @if(session('newPersonnelMsg'))
    <div class="alert alert-success">
        {{session('newPersonnelMsg')}}
    </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Personnel Form</h3>
        </div>
        <form role="form" action="{{route('insertPersonnel')}}" method="post" >
            @csrf
            <div class="card-body bg-white" >
                <div class="form-group @error('fname') has-danger @enderror">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control @error('fname') is-invalid @enderror "  placeholder="Write Firstname" name="fname">
                    @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('lname') has-danger @enderror">
                    <label for="exampleInputPassword1">Second Name</label>
                    <input type="text" class="form-control @error('lname') is-invalid @enderror"  placeholder="Write Second Name" name="lname">
                    @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('username') has-danger @enderror">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror"  placeholder="Write Username" name="username">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('email') has-danger @enderror">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Write Email" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('password') has-danger @enderror ">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('phone') has-danger @enderror ">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"  placeholder="Write Phone Number" name="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
