@extends('layouts.common-1')

@section('title')
    Ethiochef | Subscribe
@endsection

@section('content')

    <div class="row" style="margin: 0">
        <div class="col-sm-6 login-info">
            <h1 style="color: black">Everyone Can Cook!</h1>
            <p class="text-justify" style="color: black">
                EthioCheff is a recipe web application with image and video based on food making guidance,
                also it is used for searching, sharing and saving recipes.
                This web application provides flexibility to user to search variety of Ethiopian and European
                recipes from available recipes in the forum. In addition, the it will provide the users with
                two distinct features such as the first category is Habesha recipe and the second is
                European main dish recipe.
            </p>
        </div>

        <div class="col-sm-1 vert">

        </div>

        <div class="col-sm-5 limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-form-title" style="background-image: url({{ asset('images/kitfo.jpg') }});">
					<span class="login100-form-title-1 wow fadeInUp" data-wow-delay="0.4s">
						Ethio Chef
					</span>
                    </div>

                    <form class="login100-form validate-form wow fadeInUp" data-wow-delay="0.4s" action="{{ route('confirmation') }}" method="GET">
                        <div class="wrap-input100 validate-input m-b-26" data-validate="Phone number is required">
                            <label style="padding-bottom: 5%;font-size: 18px; font-weight: 400;">Subscribe using your phone number</label>

                            <span class="label-input100">+251</span>
                            <input class="input100" type="text" name="phonenumber" placeholder="*********" required>

                            <span class="focus-input100"></span>
                        </div>


                        <div class="flex-sb-m w-full p-b-30">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100" id="ckb1" type="checkbox" name="" required>
                                <label class="label-checkbox100" for="ckb1" style="font-weight: 400;">
                                    Agree on our <a type="button" data-toggle="modal" data-target="#policyModal"><u style="color: blue;">Privacy Policy</u> </a>
                                </label>
                            </div>
                        </div>

                        <div class="container-login100-form-btn" >
                            <button href="{{ route('confirmation') }}" type="submit" class="login100-form-btn" style="text-decoration: none;">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="policyModalLabel">Ethio Chef | Privacy Policy </h3>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; padding-top: -50px;">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <h4>
                        <b><u>Information we collect</u></b>
                    </h4>

                    <p style="color: black">
                        We will collect your phone number when you subscribe  to our service in website,
                        and we will automatically send subscritption request to ethiotelecom.
                    </p>

                    <h4>
                        <b><u>Payment</u></b>
                    </h4>

                    <p style="color: black">
                        Once you subscribed to our website or service you will pay 1 birr per day until you send unsubscription  request .
                        you can send  unsubscribe request  by clicking "unsubscribe" link on the home page.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

