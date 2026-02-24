@extends('layouts.main-layout')

@section('title')
    Contact
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contact-util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
    <div class="bg-contact2" style="background-image: url({{ asset('images/bg1.jpg') }});">
        <div class="container-contact2">
            <div class="wrap-contact2">
                <form class="contact2-form validate-form" action="{{ route('message.send') }}" method="POST">
                    @csrf

					<span class="contact2-form-title">
						Contact Us
					</span>

                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input class="input2" type="text" name="name" placeholder="NAME" required>
                        <span class="focus-input2"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input2" type="text" name="email" placeholder="EMAIL" required>
                        <span class="focus-input2"></span>
                    </div>

                    <div class="wrap-input2 validate-input" data-validate = "Message is required">
                        <textarea class="input2" name="message" placeholder="MESSAGE" required></textarea>
                        <span class="focus-input2"></span>
                    </div>

                    <div class="container-contact2-form-btn">
                        <div class="wrap-contact2-form-btn">
                            <div class="contact2-form-bgbtn"></div>
                            <button type="submit" class="contact2-form-btn">
                                Send Your Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
@endsection
