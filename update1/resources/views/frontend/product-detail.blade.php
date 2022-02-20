@extends('frontend.layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/flexslider.css" />
<style>
    .selected {
        background-color: #000066;
        color: white !important;

    }

    .disableClass {
        border: 1px solid dotted !important;
    }
</style>

@endpush
@section('content')

<div class="container">
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home">
                            <a title="Go to Home Page" href="{{ route('index') }}">Home</a><span>&raquo;</span>
                        </li>
                        @if(count($product->categories)>0)
                        <li class="">
                            <a
                                href="{{ route('category',$product->categories->first()->slug??'') }}">{{ $product->categories->first()->name??'' }}</a><span>&raquo;</span>
                        </li>
                        @endif
                        <li><strong>{{ $product->title }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <div class="row">
        <div class="col-main">
            <div class="product-view-area">
                <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
                    <div class="large-image">

                        <a href="{{ asset('storage/'.$product->thumbnail) }}" class="cloud-zoom" id="zoom1"
                            rel="useWrapper: false, adjustY:0, adjustX:20">
                            <img class="zoom-img" src="{{ asset('storage/'.$product->thumbnail) }}"
                                alt="{{ $product->title }}" />
                        </a>
                    </div>
                    <div class="flexslider flexslider-thumb">
                        <ul class="previews-list slides">
                            <li>
                                <a href="{{ asset('storage/'.$product->thumbnail) }}" class="cloud-zoom-gallery"
                                    rel="useZoom: 'zoom1', smallImage: '{{ asset('storage/'.$product->thumbnail) }}' "><img
                                        src="{{ asset('storage/'.$product->thumbnail) }}"
                                        alt="{{ $product->title }}" /></a>
                            </li>
                            @foreach ($product->images as $image)
                            <li>
                                <a href="{{ asset('storage/'.$image) }}" class="cloud-zoom-gallery"
                                    rel="useZoom: 'zoom1', smallImage: '{{ asset('storage/'.$image) }}' "><img
                                        src="{{ asset('storage/'.$image) }}" alt="{{ $product->title }}" /></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- end: more-images -->
                </div>
                @livewire('product-detail',['product'=>$product])
            </div>
        </div>
        <div class="product-overview-tab">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="product-tab-inner">
                            <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                                <li class="active">
                                    <a href="#description" data-toggle="tab">
                                        Description
                                    </a>
                                </li>
                                <li>
                                    <a href="#reviews" data-toggle="tab">Reviews</a>
                                </li>
                            </ul>
                            <div id="productTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    <div class="std">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                @livewire('review',['product'=>$product])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related-products-slider">
        <div class="related-procuts-heading">
            <p>Related Products</p>
            <a href="#">See all <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <div class="related-swiper-container">
            <div class="swiper-wrapper">
                @foreach ($related as $relate)
                <div class="swiper-slide">
                    {{ FrontEndHandler::getProductCard($relate) }}
                </div>
                @endforeach
                <div class="swiper-slide">
                    <a href="javascript:void(0);">
                        <div class="topPro-card topPro-sell-card">
                            <div class="topPro-card-img">
                                <img src="{{ asset('frontend') }}/images/click-svg.svg" alt="" />
                            </div>
                            <div class="topPro-card-text">
                                <div class="topPro-card-name">
                                    <p>Do u want to sell your items?</p>
                                </div>
                                <div class="topPro-sell-text">
                                    <p>
                                        If yes?<br />
                                        Then <span>Click here</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.flexslider.js"></script>

<!--cloud-zoom js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/cloud-zoom.js"></script>
<script>
    var swiper = new Swiper(".related-swiper-container", {
      slidesPerView: 6,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>

@endpush