
@extends('layouts.main-layout')

@section('title')
    Ethiochef | Home
@endsection

@section('content')
    <!-- THE HOME SECTION -->
    <section id="home" class="main">
        <!--<img src="images/slitting-steel-coil.PNG" id="random-img" class="overlay">-->
        <div class="overlay">

        </div>



        <div class="container">
            <div class="row">

                <div class="wow fadeInUp col-md-2">
                </div>
                <div class="wow fadeInUp col-md-10" style="margin-top: -13%">
                    <h1 style="text-align: center">Welcome to Ethio-Chef, start learn cooking</h1>
                    <h4 style="text-align: center">We are with you to cook your dinner</h4>
                </div>
            </div>
        </div>

        <div class="smoothScroll">
            <div class="search_container">
                <form action="{{ route('ethiochef') }}" method="GET">
                    <input type="text" name="search" placeholder="Search..." value="{{ request()->query('search') }}">
                </form>
                <!--            <div class="search"></div>-->
            </div>
        </div>
    </section>

    <!--================ Random FOODS =================-->
    <section class="foods">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="">
            <div class="each-food" style="margin: 1% 4%">

                <div class="row">

                    @forelse($foods as $food)
                        <div class="wow fadeInUp col-md-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">
                            <div class="food-item">
                                <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('/storage/'.$food->image) }}" width="100%" height="240px" alt=""></a></div>
                                <div class="food-content">
                                    <a href="{{ route('detail', $food->id) }}"><h3>
                                            {{ $food->name }}
                                        </h3></a>
                                    <p>
                                        {!! $food->instruction !!}
                                    </p>
                                    <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-danger">No results found!</p>
                    @endforelse


{{--                    <!--================ Those will be deleted =================-->--}}
{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail') }}"><img class="img-fluid" src="{{ asset('images/meat2.jpg') }}" height="240px" width="100%"></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail') }}"><h3>Meat product two</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail') }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail') }}"><img class="img-fluid" src="{{ asset('images/breakfast2.jpg') }}" width="100%" height="240px" alt=""></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail') }}"><h3>Break fast two</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail') }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div >--}}

{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail') }}"><img class="img-fluid" src="{{ asset('images/tibs.jpg') }}" height="240px" width="100%"></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail') }}"><h3>The Ethiopian Tibs</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail') }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                            <div class="food-item">--}}
{{--                                <div class="food-img"><a href="{{ route('detail') }}"><img class="img-fluid" src="{{ asset('images/super3.jpg') }}" width="100%" height="240px" alt=""></a></div>--}}
{{--                                <div class="food-content">--}}
{{--                                    <a href="{{ route('detail') }}"><h3>The Best Burger</h3></a>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                        Fusce posuere...</p>--}}
{{--                                    <a class="more_btn" href="{{ route('detail') }}">DETAIL &#8594;</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        {{ $foods->links() }}--}}
                </div>
                <div class="wow fadeInUp col-sm-4 row" data-wow-delay="0.6s" style="padding-right: 3%; padding-left: 3%">
                    {{ $foods->appends(['search'=>request()->query('search')])->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

