@extends('layouts.adminDashboard')

@section('content')

    @if(session('insertDriverMSG'))
        <div class="alert alert-success">
            {{session('insertDriverMSG')}}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Driver Form</h3>
        </div>
        <form role="form" method="post" action="{{route('insertDriver')}}">
            @csrf
            <div class="card-body bg-white">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" class="form-control"  placeholder="Write Firstname" name="fname">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" class="form-control"  placeholder="Write Lastname" name="lname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputPassword1">Username</label>
                        <input type="text" class="form-control"  placeholder="Write Second Name" name="username" >
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Write Email" name="email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" class="form-control"  placeholder="Write Phone Number" name="phone">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control"  placeholder="Write Address" name="address">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputPassword1">Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="birthdate">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Licence Number</label>
                        <input type="text" class="form-control"  placeholder="Write Licence Number" name="lnumber">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputPassword1">Licence Creation Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Write Date" name="lcdate">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Licence Expiration Date</label>
                        <input type="date" class="form-control"  placeholder="Write Date" name="ledate">
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputPassword1">Licence Type</label>
                        <select name="ltype" class="form-control">
                            <option disabled selected>None</option>
                            <?php
                            $a1=0;
                            while ($a1<count($data['Ltype'])){  ?>
                            <option value="{{$data['Ltype'][$a1]->id}}">{{\Illuminate\Support\Facades\Crypt::decryptString($data['Ltype'][$a1]->licence_type)}}</option>
                       <?php  $a1++;
                            }
                            ?>
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
