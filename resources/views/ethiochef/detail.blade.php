
@extends('layouts.main-layout')

@section('title')
{{ $food->name }}
@endsection

@section('content')

    <section class="youtube_videos">

        <div class="videos" >
            <h1 style="color: black; text-align: center; padding-top: 50px">
                {{ $food->name }}
            </h1>
            @if($food->video)
                <div class="video wow fadeInUp" style="padding-top: 4%; padding-bottom: 4%; alignment: center" data-wow-delay="0.4s">
                    <video class="video-kitfo" height="40%" controls >
                        <source src="{{ asset('storage/'.$food->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
        </div>

    </section>


    <!--================ Ingredients && Instructions =================-->
    <section class="foods">
        <div class="">
            <div class="each-food" style="margin: 1% 4%">

                <div class="row">
                    <div class="wow fadeInUp col-sm-5" style="padding-right: 3%; padding-left: 3%; padding-bottom: 5%">
                        <div class="food-item">
                            <div class="food-content" style="text-align: left">
                                <h3 style="text-align: center">The ingredients</h3>
                                {!! $food->ingredient !!}
                            </div>
                        </div>
                    </div>

                    <div class="wow fadeInUp col-sm-7" style="padding-right: 3%; padding-left: 3%">
                        <div class="food-item">
                            <div class="food-content" style="text-align: left">
                                <h3 style="text-align: center">The instruction</h3>
                                {!! $food->instruction !!}
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </section>



@endsection
