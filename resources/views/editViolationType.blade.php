@extends('layouts.adminDashboard')

@section('content')
    @if(session('updateViolationType'))
        <div class="alert alert-success">
            {{session('updateViolationType')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Violation Type Form</h3>
        </div>
        <form role="form" action="{{route('updateViolation')}}" method="post" >
            @csrf
            <div class="card-body bg-white" >

                <input type="hidden" name="vid" value="{{$violation->id}}">
                <div class="form-group @error('type') has-danger @enderror">
                    <label for="exampleInputEmail1">Violation </label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror "  placeholder="Write Violation Type" name="type" value="{{\Illuminate\Support\Facades\Crypt::decryptString($violation->type)}}">
                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('money') has-danger @enderror">
                    <label for="exampleInputEmail1">Amount money</label>
                    <input type="text" class="form-control @error('money') is-invalid @enderror "  placeholder="Write Amount Money" name="money" value="{{\Illuminate\Support\Facades\Crypt::decryptString($violation->money)}}">
                    @error('money')
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
