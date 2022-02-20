@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid">

    <div class="sell-banner">
        <div class="sell-banner-box">
        </div>
        <div class="sell-banner-box-text">
            <h2>
                Sell With Us
            </h2>
        </div>
    </div>
    <div class="sell-background">
        <div class="container-xs ">
            <div class="sell-box">
                <div class="sell-header">
                    <div class="row justify-content-md-center">
                        <div class="col-md-3">
                            <img src="{{ asset('frontend') }}/images/sell.svg" alt="">
                        </div>
                        <div class="col-md-7 sell-header-right">
                            <div class="sell-header-heading">
                                Sell With Us
                            </div>
                            <div class="sell-header-subheading">
                                Become a partner
                            </div>
                        </div>
                    </div>
                </div>
                @livewire('vendor-register')
            </div>
        </div>
    </div>
</div>

@endsection