@extends('layouts.personnel')

@section('personnel_content')
    @if(session('insertDVmessage'))
        <div class="alert alert-success">
            {{session('insertDVmessage')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Violation Form</h3>
        </div>
        <form role="form" action="{{route('insertDriverViolation')}}" method="post" >
            @csrf
            <input type="hidden" name="driver_id"  id="driver_id">
            <div class="card-body bg-white" >
                <div class="form-group @error('automobile_number') has-danger @enderror" id="plate">
                    <label for="exampleInputEmail1">Automobile Number</label>
                    <input type="text" class="form-control @error('automobile_number') is-invalid @enderror "  placeholder="Write Automobile Number" name="automobile_number" id="automobile_number" >
                    @error('automobile_number')
                    <span class="invalid-feedback" role="alert">
                        <strong id="plate_message">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('violation_type') has-danger @enderror">
                    <label for="exampleInputEmail1">Select Violation Type</label>
{{--                    <input type="text" class="form-control @error('violation_type') is-invalid @enderror "  placeholder="Write Violation  Type" name="violation_type">--}}
                    <select name="violation_type" class="form-control">
                        <option disabled selected>None</option>
                        <?php
                        $a=0;
                        while ($a<count($violations)){ ?>
                        <option value="{{$violations[$a]->id}}">{{\Illuminate\Support\Facades\Crypt::decryptString($violations[$a]->type)}}</option>

                    <?php    $a++; }
                        ?>
                    </select>
                    @error('violation_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('violation_location') has-danger @enderror">
                    <label for="exampleInputEmail1">Vehicle Location</label>
                    <input type="text" class="form-control @error('violation_location') is-invalid @enderror "  placeholder="Write Violation Location " name="violation_location">
                    @error('violation_location')
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

    <script>

        $(document).ready(function(e){
            $('#automobile_number').on('change',function(e){
                var automobile_number = $(this).val();
                e.preventDefault();
                $.ajax({
                    url:"/checkforAutomobile",
                    type:"GET",
                    data:{data:automobile_number},
                    success:function(data){
                        var data1 = JSON.parse(data);
                        if (data1[0] == null){
                            $("#plate").addClass('has-danger');
                            $("#automobile_number").addClass('is-invalid');
                            $('#driver_id').val("");
                        }else{
                            $("#plate").removeClass('has-danger');
                            $("#automobile_number").removeClass('is-invalid');
                            $('#driver_id').val(data1[0].driver_id);
                        }


                    }
                });
            })
        })
    </script>
@endsection
