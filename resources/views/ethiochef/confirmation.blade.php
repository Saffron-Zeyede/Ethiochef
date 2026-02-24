@extends('layouts.common-1')

@section('title')
    Confirmation
@endsection

@section('content')


    <div class="row" style="margin: 0">
        <div class="col-md-5 login-info">
            <h1 style="color: black">Everyone Can Cook.</h1>
            <p style="font-size: 22px; color: black; margin-left: 10%">
                Enjoy cooking with us
            </p>
        </div>

        <div class="col-md-6 limiter">
            <div class="container-login100">
                <div class="wrap-login100" style="width: 350px">
                    <div style="text-align: center; margin-right: 3%; margin-top: 30px; margin-bottom: -20px">
                        <img src="{{ asset('images/msgbox.png') }}" alt="">
                    </div>

                    <form class="login100-form validate-form wow fadeInUp" data-wow-delay="0.4s" action="{{ route('ethiochef') }}" method="GET">
                        <div class="validate-input m-b-26" data-validate="Confirmation Code is required">
                            <div style="padding-bottom: 5%; margin-top: -40px; font-weight: 400; text-align: center">
                                <p style="color: #121d39; font-size: 23px">We have sent code to</p>
                                <p style="color: #121d39; font-size: 23px">{{ $phonenumber }}</p>
                            </div>



                            <div class="input-code" style="margin-bottom: 5px">
                                <input type="text" name="code" id="code" placeholder="Enter code">
                            </div>

                        </div>



                        <div class="container-login100-form-btn" >
                            <a type="button" class="btn btn-primary" href="{{ route('ethiochef') }}" style="text-decoration: none;background: #121d39; width: 85%">
                                Enter code
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
