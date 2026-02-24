
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

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')

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
            <a href="{{ route('ethiochef') }}" class="navbar-brand" >
                <img class="" src="{{ asset('images/logo-final-white.png') }}" alt="logo" width="175px" height="85px" style="display: inline">
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">


                <li><a href="{{ route('ethiochef') }}" class="smoothScroll">Home</a></li>

                <li class="dropdown">
                    <a class="smoothScroll">Food Categories</a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category', $category->id) }}" class="smoothScroll" style="color: #bab6b6">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Meat Products</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Habesha Dishes</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">European Dishes</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Breakfast</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Lunch</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Super</a></li>--}}
{{--                        <li><a href="{{ route('categories', $category->id) }}" class="smoothScroll">Dinner</a></li>--}}
                    </ul>
                </li>

                <li><a href="{{ route('contact') }}" class="smoothScroll">Contact</a></li>
                <li><a href="{{ '/' }}" class="smoothScroll">Unsubscribe &rarr;</a></li>
            </ul>
        </div>

    </div>
</div>


@yield('content')

<!-- THE FOOTER -->
<footer style="margin-top: 100px">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="wow fadeInUp footer-copyright" data-wow-delay="0.4s">
                    <img src="{{ asset('images/logo-final-white.png') }}" class="" width="190px" height="100px">
                </div>
                <div class="wow fadeInUp footer-copyright" data-wow-delay="0.4s" style="margin: 0">
                    <p style="color: white">Copyright &copy;2026 Ethio Chef. All rights reserved.</p>
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

@yield('script')
</body>
</html>
