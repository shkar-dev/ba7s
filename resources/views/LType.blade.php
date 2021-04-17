@extends('layouts.adminDashboard')

@section('content')
    @if(session('lTypeMSG'))
        <div class="alert alert-success">
            {{session('lTypeMSG')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> Licence Type Form</h3>
        </div>
        <form role="form" action="{{route('insertLtype')}}" method="post" >
            @csrf
            <div class="card-body bg-white" >
                <div class="form-group @error('licence_type') has-danger @enderror">
                    <label for="exampleInputEmail1">Licence Type</label>
                    <input type="text" class="form-control @error('licence_type') is-invalid @enderror "  placeholder="Write Licence Type" name="licence_type">
                    @error('licence_type')
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
