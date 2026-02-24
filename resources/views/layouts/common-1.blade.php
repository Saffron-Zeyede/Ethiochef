<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>
        @yield('title')
    </title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ 'css/font-awesome.min.css' }}">

    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">





    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style-outer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">


</head>

<body>

<!-- THE NAVIGATION -->
<div class="navbar navbar-default navbar-fixed-top">

    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <!--            <a href="ethiochef" class="navbar-brand" style="padding-top: 30px">Ethio - Chef</a>-->
            <a href="{{ '/' }}" class="navbar-brand" ><img class="" src="{{ asset('images/logo-final-white.png') }}" alt="logo" width="175px" height="85px" style="display: inline; margin-top: -7px"></a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">


                <li><a href="{{ '/' }}" class="smoothScroll">Home</a></li>

                <li><a href="{{ route('contact') }}" class="smoothScroll">Contact</a></li>
            </ul>
        </div>

    </div>
</div>

@yield('content')

<!-- THE FOOTER -->
<footer style="margin-top: -50px">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="wow fadeInUp footer-copyright" data-wow-delay="0.4s">
                    <img src="images/logo-final-white.png" class="" width="190px" height="100px">
                </div>
                <div class="wow fadeInUp footer-copyright" data-wow-delay="0.4s" style="margin: 0">
                    <p style="color: white">Copyright &copy;2025 Ethio Chef. All rights reserved.</p>
                </div>
            </div>

            <div class="col-sm-5" style="padding-top: 70px">
                <ul class="wow fadeInUp social-icon" data-wow-delay="0.8s">
                    <li><a href="https://web.facebook.com/Dnsaffron/" class="fa fa-facebook"></a></li>
                    <li><a href="https://x.com/SaffronZeyede" class="fa fa-twitter"></a></li>
                    <li><a href="https://www.linkedin.com/in/saffron-zeyede-b40758353" class="fa fa-linkedin"></a></li>
                    <li><a href="https://www.youtube.com/@Dnsaffron" class="fa fa-youtube"></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>

<!-- SCRIPTS -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script> -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup-options.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/smoothscroll.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
