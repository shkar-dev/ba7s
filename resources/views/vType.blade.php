@extends('layouts.adminDashboard')

@section('content')
    @if(session('vTypeMSG'))
        <div class="alert alert-success">
            {{session('vTypeMSG')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Vehicle Type Form</h3>
        </div>
        <form role="form" action="{{route('insertVType')}}" method="post" >
            @csrf
            <div class="card-body bg-white" >
                <div class="form-group @error('vehicle_type') has-danger @enderror">
                    <label for="exampleInputEmail1">Vehicle Type</label>
                    <input type="text" class="form-control @error('vehicle_type') is-invalid @enderror "  placeholder="Write Vehicle Type" name="vehicle_type">
                    @error('vehicle_type')
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
