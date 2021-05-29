@extends('layouts.adminDashboard')

@section('content')

    @if(session('vehicleinsertSuccess'))
        <div class="alert alert-success">
            {{session('vehicleinsertSuccess')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Vehicle Form</h3>
        </div>
        <form role="form" method="post" action="{{route('insertVehicle')}}">
            @csrf

            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Model Name</label>
                        <input type="text" class="form-control"  placeholder="Write Model Name" name="cmname">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Model Number</label>
                        <input type="text" class="form-control"  placeholder="Write Model Number" name="cmnumber">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Color</label>
                        <input type="text" class="form-control"  placeholder="Write Color" name="ccolor" >
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Model Year</label>
                        <input type="text" class="form-control"  placeholder="Write Model Year" name="cmyear">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Manufacture</label>
                        <input type="text" class="form-control"  placeholder="Write Manufacture" name="cmanufacture">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Plate Number</label>
                        <input type="text" class="form-control"  placeholder="Plate Number" name="cplatenumber">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Automobile Type</label>
                        <select name="ctype" class="form-control">
                            <option disabled selected>None</option>
                            <?php
                            $a=0;
                            while ($a<count($data['type'])){?>
                            <option value="{{$data['type'][$a]->id}}">{{\Illuminate\Support\Facades\Crypt::decryptString($data['type'][$a]->type_name)}}</option>
                            <?php  $a++; }?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Driver</label>
                        <select name="driver" class="form-control">
                            <option disabled selected>None</option>
                            <?php
                            $a=0;
                            while ($a<count($data['driver'])){?>
                            <option value="{{$data['driver'][$a]->id}}">{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->fname)." ".\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->lname)}}</option>
                            <?php  $a++; }?>
                        </select>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
