@extends('frontend.layouts.master')

@section('content')
{{ FrontEndHandler::banner() }}
{{ FrontEndHandler::hotProducts() }}
{{ FrontEndHandler::getHomePageCategories() }}
{{ FrontEndHandler::topProducts() }}
{{ FrontEndHandler::getAds(1) }}
{{ FrontEndHandler::highlights() }}
{{ FrontEndHandler::featuredProducts() }}
{{ FrontEndHandler::getAds(2) }}




@endsection