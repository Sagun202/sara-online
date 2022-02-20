@extends('frontend.layouts.master')

@section('content')

<div class="padd">
    <figure class="entry-media">
        <img style="width: 100%; height:500px" src="{{ asset('storage/'.$blog_details->image) }}" alt="image desc">
    </figure><!-- End .entry-media -->
    <div class="container" style="background: white">
        <article class="entry single-entry entry-fullwidth">
            <div class="row">
                <div class="col-lg-11">
                    <div class="entry-body">
                        <div class="entry-meta">
                           
                            <span class="meta-separator">|</span>
                            <a href="#">{{$blog_details->created_at}}</a>
                            <span class="meta-separator">|</span>
                      
                        </div><!-- End .entry-meta -->

                        <h2 class="entry-title entry-title-big">
                            {{$blog_details->title}}
                        </h2><!-- End .entry-title -->

                       
                        <div class="entry-content editor-content" >
                            {!!$blog_details->description!!}
                        </div><!-- End .entry-content -->

                    </div><!-- End .entry-body -->
                </div><!-- End .col-lg-11 -->

                <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
                    <div class="sticky-content" style="">
                        <div class="social-icons social-icons-colored social-icons-vertical">
                            <span class="social-label">SHARE:</span>
                            <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .sticky-content -->
                </div><!-- End .col-lg-1 -->
            </div><!-- End .row -->

           
        </article><!-- End .entry -->

        

      
    </div><!-- End .container -->
</div>


@endsection