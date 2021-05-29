@extends('layouts.adminDashboard')

@section('content')

    @if(session('updateSuccessMSGdriver'))
        <div class="alert alert-success">
            {{session('updateSuccessMSGdriver')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Driver Form</h3>
        </div>
        <form role="form"  action="{{route('UpdateDriver')}}" method="post">
            @csrf
            <input type="hidden" name="driverID" value="{{$driverInfo[0]->id}}">
            <input type="hidden" name="userID" value="{{$driverInfo[0]->UID}}">
            <div class="card-body bg-white" >
                <div class="form-group @error('fname') has-danger @enderror">
                    <label for="exampleInputEmail1">FirstName</label>
                    <input type="text" class="form-control @error('fname') is-invalid @enderror "  placeholder="Write Firstname" name="fname" value="{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[0]->fname)}}">
                    @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('lname') has-danger @enderror">
                    <label for="exampleInputEmail1">Lastname</label>
                    <input type="text" class="form-control @error('lname') is-invalid @enderror "  placeholder="Write Lastname" name="lname"value="{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[0]->lname)}}">
                    @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('username') has-danger @enderror">
                    <label for="exampleInputEmail1">username</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror "  placeholder="Write username" name="username" value="{{$driverInfo[0]->username}}">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('email') has-danger @enderror">
                    <label for="exampleInputEmail1">email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror "  placeholder="Write email" name="email" value="{{$driverInfo[0]->email}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('password') has-danger @enderror">
                    <label for="exampleInputEmail1">password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror "  placeholder="Write password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('phone') has-danger @enderror">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror "  placeholder="Write Phone" name="phone" value="{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[0]->phone)}}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group @error('address') has-danger @enderror">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror "  placeholder="Write Location" name="address" value="{{\Illuminate\Support\Facades\Crypt::decryptString($driverInfo[0]->address)}}">
                    @error('address')
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
