@extends('layouts.driver')

@section('driver_content')

    @if(session('paymentSuccessMessage'))
        <div class="alert alert-success" >
            {{session('paymentSuccessMessage')}}
            @endif
        </div>

        {{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
        {{--            Launch demo modal--}}
        {{--        </button>--}}

        <!-- Modal -->

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Driver Information  </h3>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form>
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Username</label>
                                    <input type="text" id="input-username" class="form-control" placeholder="Username" value="{{$data[0]->username}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email address</label>
                                    <input type="email" id="input-email" class="form-control" value="{{$data[0]->email}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">First name</label>
                                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="{{\Illuminate\Support\Facades\Crypt::decryptString($data[0]->fname)}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Last name</label>
                                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="{{\Illuminate\Support\Facades\Crypt::decryptString($data[0]->lname)}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address">Address</label>
                                    <input id="input-address" class="form-control" placeholder="Home Address" value="{{\Illuminate\Support\Facades\Crypt::decryptString($data[0]->address)}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Wallet</label>
                                    <input type="text" id="input-city" class="form-control"  value="{{\Illuminate\Support\Facades\Crypt::decryptString($data[0]->wallet)}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Phone</label>
                                    <input type="text" id="input-country" class="form-control" value="{{\Illuminate\Support\Facades\Crypt::decryptString($data[0]->phone)}}" disabled>
                                </div>
                            </div>

                        </div>
                    </div>


                </form>
            </div>
        </div>



@endsection
