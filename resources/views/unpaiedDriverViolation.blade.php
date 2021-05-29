@extends('layouts.driver')

@section('driver_content')
        <link rel="stylesheet" href="{{asset('stripe/global.css')}}">
    @if(session('paymentSuccessMessage'))
        <div class="alert alert-success" >
            {{session('paymentSuccessMessage')}}
            @endif
        </div>

{{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--            Launch demo modal--}}
{{--        </button>--}}

        <!-- Modal -->


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">


                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Form</h5>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('afterPayment')}}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">

                                <input type="hidden" name="email"  value="{{\Illuminate\Support\Facades\Auth::guard()->user()->email}}">
                                <input type="hidden" name="violation_id" id="violation_id">
                                <div id="card-element" class="form-control">

                                </div>
                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <button>Submit Payment</button>
                        </form>

                    </div>


                </div>

            </div>
        </div>


        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">My Violation</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive bg-white" >
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Type</th>
                            <th>location</th>
                            <th>model Name</th>
                            <th>plate number</th>
                            <th>Date</th>
                            <th> money</th>
                            <th>pay for violation</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a=0;
                        while ($a<count($data['driver'])){  ?>
                        <tr>
                            <input type="hidden" name="vid.<?php echo $data['driver'][$a]->id; ?>" value="{{$data['driver'][$a]->id}}" id="vid.<?php echo $data['driver'][$a]->id; ?>">
                            <td>{{$data['driver'][$a]->id}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->type)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->location)}}</td>
                            <td>{{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->model_name). " ".\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->model_year)}}</td>
                            <td>{{$data['driver'][$a]->plate_number}}</td>
                            <td>{{$data['driver'][$a]->violation_date}}</td>
                            <td>${{\Illuminate\Support\Facades\Crypt::decryptString($data['driver'][$a]->money)}}</td>

                            <td><button type="button" class="btn btn-outline-dark paymodalform"  data-toggle="modal" id="<?php echo $data['driver'][$a]->id; ?>" data-target="#exampleModal" ><span class="fa fa-credit-card"></span></button></td>
                        </tr>
                        <?php       $a++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)

            var stripe = Stripe('pk_test_51IAF9cBPwKjIKAwsJIXcB7oDm6NBqAyjtZQmhQCdGLVpQUBpW30GaR9dzA5mkyX8zqW6zxQSohY5sMtdx5giodtS00ZPPIWwAQ');

            // Create an instance of Elements
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Style button with BS
            document.querySelector('#payment-form button').classList =
                'btn btn-primary btn-block mt-4';

            // Create an instance of the card Element
            var card = elements.create('card', { style: style });

            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        </script>

        <script>

            $(document).ready(function (){
                $('.paymodalform').on('click',function (){
                   var vid=$(this).prop('id');
                   $('#violation_id').val(vid);
                })
            })
        </script>



@endsection
