
@extends('layouts.main-layout')

@section('title')
    Detail
@endsection

@section('content')


    <section class="youtube_videos">

        <div class="videos" >
            <h1 style="color: black; text-align: center; padding-top: 50px">Watch the video</h1>
            <div class="video wow fadeInUp" style="padding-top: 4%; padding-bottom: 4%; margin-left: 20%" data-wow-delay="0.4s" style="alignment: center">
                <video class="video-kitfo" width="70%" height="40%" controls >
                    <source src="{{ asset('videos/foodmaking.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

    </section>


    <!--================ Ingredients && Instructions =================-->
    <section class="foods">
        <div class="">
            <div class="each-food" style="margin: 1% 4%">

                <div class="row">
                    <div class="wow fadeInUp col-sm-5" style="padding-right: 3%; padding-left: 3%">
                        <div class="food-item">
                            <div class="food-content">
                                <h3>The ingredients</h3>
                                <ul style="text-align: justify;font-size: 17px; line-height: 40px; color: #626277">
                                    <li>
                                        1/2ኪ.ግየተፈጨ ታላቅ ስጋ
                                    </li>
                                    <li>
                                        3 ማንኪያ ሚጥሚጣ
                                    </li>
                                    <li>
                                        3 ማንኪያ ኮርሪማ
                                    </li>
                                    <li>
                                        1 የሻይማንኪያ ጨው
                                    </li>
                                    <li>
                                        1/2የሾርባ ማንኪያ ቅቤ
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="wow fadeInUp col-sm-7" style="padding-right: 3%; padding-left: 3%">
                        <div class="food-item">
                            <div class="food-content">
                                <h3>The instruction</h3>
                                <ol style="font-size: 18px; line-height: 40px; color: #626277">
                                    <li>
                                        ሰጋ፣ሚጥሚጣ፣ኮረሪማ፣ጨው ማዋሃድ
                                    </li>
                                    <li>
                                        ቅቤውን መጥበሻ ላይ ማቅለጥ
                                    </li>
                                    <li>
                                        ስጋውን መጨመር
                                    </li>
                                    <li>
                                        ከ5-10 ደቂቃ ስጋው ለብ እስኪል ማዋሀድ
                                    </li>
                                    <li>
                                        ለብ ሲል በቃሪያ እና ከቆጮ ጋር አስጊጦ ማቅረብ
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </section>


@endsection
