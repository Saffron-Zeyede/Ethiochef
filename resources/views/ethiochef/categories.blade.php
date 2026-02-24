
@extends('layouts.main-layout')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <!-- The Meat - Home Section -->
    <section id="home-meat" style="padding-bottom: 100px; background: rgba(212, 18, 7, 0.38) url( {{ asset('storage/'.$category->image) }}) no-repeat;background-size: cover; height: auto" class="main">
        <div class="overlay">

        </div>

        <div class="container">
            <div class="row">

                <div class="wow fadeInUp col-sm-4" data-wow-delay="0.2s">
                    <img src="{{ asset('images/logo-final-white.png') }}" class="img-responsive" alt="Home">
                </div>

                <div class="col-sm-8" style="text-align: left">
                    <div class="home-thumb">
                        <h1 class="wow fadeInUp" data-wow-delay="0.6s">
                            {{ $category->name }}
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay="0.8s" style=" font-size: 18px">
                            {!! $category->description !!}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--================ Random FOODS =================-->
    <section class="foods">
        <div class="">
            <div class="each-food" style="margin: 1% 4%">

                <div class="row">

{{--                    I had to use route-model binding ... --}}

                    @if($foods->count() > 0)
                        @foreach($foods as $food)
                            <div class="wow fadeInUp col-md-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">
                                <div class="food-item">
                                    <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('storage/'.$food->image)}}" width="100%" height="240px" alt=""></a></div>
                                    <div class="food-content" style="line-height: 25px; text-align: left">
                                        <a href="{{ route('detail', $food->id) }}" style="text-align: center"><h3>
                                                {{ $food->name }}
                                            </h3></a>
                                        <p>
                                            {!! $food->instruction !!}
                                        </p>
                                        <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <h3 class="text-center text-danger">No Foods under this food category</h3>
                    @endif




{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('images/meat2.jpg') }}" height="240px" width="100%"></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail', $food->id) }}"><h3>Meat product two</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('images/meat3.jpg') }}" width="100%" height="240px" alt=""></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail', $food->id) }}"><h3>Meat Product three</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('images/dinner2.jpg') }}" width="100%" height="240px" alt=""></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail', $food->id) }}"><h3>Product sample four</h3></a>--}}
{{--                                <p>Its Prepared From Meet which can easily made in home with 3 ingredients,--}}
{{--                                    it is delicious with Kocho...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div >--}}

{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('images/european3.png') }}" height="240px" width="100%"></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail', $food->id) }}"><h3>Product sample five</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="wow fadeInUp col-sm-4" style="padding-right: 3%; padding-left: 3%; padding-top: 80px">--}}
{{--                        <div class="food-item">--}}
{{--                            <div class="food-img"><a href="{{ route('detail', $food->id) }}"><img class="img-fluid" src="{{ asset('images/tibs.jpg') }}" width="100%" height="240px" alt=""></a></div>--}}
{{--                            <div class="food-content">--}}
{{--                                <a href="{{ route('detail', $food->id) }}"><h3>Product sample six</h3></a>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.--}}
{{--                                    Fusce posuere...</p>--}}
{{--                                <a class="more_btn" href="{{ route('detail', $food->id) }}">DETAIL &#8594;</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>

                <div class="wow fadeInUp col-sm-4 row" data-wow-delay="0.6s" style="padding-right: 3%; padding-left: 3%">
                    {{ $foods->links() }}
                </div>

            </div>
        </div>
    </section>

@endsection
