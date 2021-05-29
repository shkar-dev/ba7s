@extends('layouts.adminDashboard')

@section('content')
    @if(session('successViolationInsert'))
        <div class="alert alert-success">
            {{session('successViolationInsert')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Violation Type Form</h3>
        </div>
        <form role="form" action="{{route('insertViolationType')}}" method="post" >
            @csrf
            <div class="card-body bg-white" >
                <div class="form-group @error('violation_type') has-danger @enderror">
                    <label for="exampleInputEmail1">Violation Type</label>
                    <input type="text" class="form-control @error('violation_type') is-invalid @enderror "  placeholder="Write Violation Type" name="violation_type">
                    @error('violation_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('violation_price') has-danger @enderror">
                    <label for="exampleInputEmail1">Vehicle Price</label>
                    <input type="text" class="form-control @error('violation_price') is-invalid @enderror "  placeholder="Write Violation Price " name="violation_price">
                    @error('violation_price')
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
