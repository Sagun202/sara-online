@extends('frontend.layouts.master')

@section('content')

<div class="about-banner1">
</div>
<div class="about-content1">
    <div class="container-xs">
        <div class="about-content1-heading">About Us</div>
        <p><span>
                ClickMart
            </span> is a online website, where we always strive to provide quality products to our fellow customers.
        </p>
        <p>
            We're a group of people who are wildly <span>passionate</span> about changing the way content is created
            on the web. We believe content creation has been constrained by technology for too long and creativity
            has taken a backseat. We exist to unlock creativity. Our platform empowers the world's leading brands to
            share their stories and engage their audiences.</p>
    </div>
</div>
<div class="about-content2">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="about-content2-box">
                    <div class="about-content2-box-heading">
                        Our Mission
                    </div>
                    <div class="about-content-box-text">
                        <p>To be the the first choice of our customers, in terms of online shopping</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="about-content2-box">
                    <div class="about-content2-box-heading">
                        Our Vision
                    </div>
                    <div class="about-content-box-text">
                        <p>A staple online shopping site to remove gap between customers and goods</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="about-content2-box">
                    <div class="about-content2-box-heading">
                        Our Values
                    </div>
                    <div class="about-content-box-text">
                        <p>To be a platform to provide happiness to our family and customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="careers-page">
    <div class="career-banner1">
    </div>
    <div class="career-heading">
        Career at ClickMart
    </div>
    <div class="career-content1">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="career-content1-left">
                        <div class="career-content1-left-heading">
                            Join ClickMart
                        </div>
                        <div class="career-content1-left-subheading">
                            ClickMart for making dream working space
                        </div>
                        <div class="career-content1-left-text">
                            We are always eager to be a place where <span>innovation</span> is
                            transformed from dream into reality.People from 66 di­fferent countries work here - you
                            get to experience so many diff­erent cultures, working styles and stories at work!
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="career-content1-right">
                        <div class="career-content1-right-img">
                            <img src="{{ asset('frontend') }}/images/career1-img.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="career-content2">
        <div class="container">
            <div class="career-heading">
                Our Openings
            </div>
            <div class="career-content2-box">
                <div class="career-content2-box-heading">Current Openings</div>
                <div class="career-content2-box-subheading">We always admire your dedication and creativity. Apply
                    where u feel u belong to.</div>
                <hr>
                <!--<div class="career-content2-box-list">-->
                <!--    @foreach (FrontEndHandler::getVacancies() as $vacancy)-->
                <!--    <div class="career-content2-box-line">-->
                <!--        <div class="row">-->
                <!--            <div class="col-sm-6">-->
                <!--                <div class="career-content2-box-line-job">-->
                <!--                    <a href="{{ route('jobs.detail',$vacancy->slug) }}">{{ $vacancy->title }}</a>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-sm-3">-->
                <!--                <div class="career-content2-box-line-category">-->
                <!--                    <i class="fas fa-users"></i>-->
                <!--                    <p>{{ $vacancy->no_of_opening }} Openings</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-sm-3">-->
                <!--                <div class="career-content2-box-line-shift">-->
                <!--                    <i class="far fa-clock"></i>-->
                <!--                    <p>{{ $vacancy->type }}</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <hr>-->
                <!--    </div>-->
                <!--    @endforeach-->

                <!--</div>-->
            </div>
        </div>
    </div>
</div>


@endsection