@extends('frontend.layouts.master')

@section('content')
    <br>
    <div class="padd">
    <div style="background: white;  border-radius:20px" >

@foreach ($blog_lists as $list)

<article style="background: white; padding:50px; " class="entry container entry-list">
    <div class="row align-items-center">
        <div class="col-md-5">
            <figure class="entry-media">
                <a href="{{route('blogs',$list->slug)}}">
                    <img src="{{ asset('storage/'.$list->image) }}" alt="{{$list->title}}">
                </a>
            </figure><!-- End .entry-media -->
        </div><!-- End .col-md-5 -->

        <div class="col-md-7">
            <div class="entry-body">
                <div class="entry-meta">
                  
                    <span class="meta-separator">|</span>
                    <a href="{{route('blogs',$list->slug)}}">{{$list->created_at}}</a>
                    <span class="meta-separator">|</span>
               
                </div><!-- End .entry-meta -->

                <h2 class="entry-title">
                    <a href="{{route('blogs',$list->slug)}}">{{$list->title}}</a>
                </h2><!-- End .entry-title -->



                <div class="entry-content" >
                    <p>{{$list->short_description}}</p>
                    <a href="{{route('blogs',$list->slug)}}" class="read-more">Continue Reading</a>
                </div><!-- End .entry-content -->
            </div><!-- End .entry-body -->
        </div><!-- End .col-md-7 -->
    </div><!-- End .row -->
</article><!-- End .entry -->
<hr>
@endforeach

    </div>
<div>
    @endsection