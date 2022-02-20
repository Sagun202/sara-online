

<div class="row" style="align-content: center; align-items:center; justify-content: center;  ">
    <div class="col-3">
       <hr style="  background: #001768; height:2px;">
    </div>

    <div class="col-2">
       <center>
          <button class=" rounded-pill btn-primary" style="background: #001768; color:white font-size:15px;"> OUR BLOGS </button>
       </center>
       
    </div>
    <div class="col-3">
       <hr style="  background: #001768; height:2px;">
    </div>
 </div>
 <br>

<div class="row padd">





    <div class="row justify-content-center">
         @foreach ($blogs ->take(1) as $blog)
        <div class="col-sm-6 col-lg-3">
            <div>
                <div class="banner banner-cat banner-link-anim">
                    <a href="{{route('blogs',$blog->slug)}}">
                        <img src="{{ asset('storage/'.$blog->image) }}" alt="{{$blog->title}}">
                    </a>
    
                    <div class="banner-content banner-content-bottom">
                        <h3 class="banner-title">{{$blog->title}}</h3><!-- End .banner-title -->
                        <h4 class="banner-subtitle">{{$blog->short_description}} </h4><!-- End .banner-subtitle -->
                    
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-md-6 -->
        @endforeach

            <div class="">
                @foreach ($blogs ->skip(1)->take(1) as $blog)
                <div class="banner banner-cat banner-link-anim">
                    <a href="{{route('blogs',$blog->slug)}}">
                        <img src="{{ asset('storage/'.$blog->image) }}" alt="{{$blog->title}}">
                    </a>
    
                    <div class="banner-content banner-content-bottom">
                        <h3 class="banner-title">{{$blog->title}}</h3><!-- End .banner-title -->
                        <h4 class="banner-subtitle">{{$blog->short_description}} </h4><!-- End .banner-subtitle -->
                    
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
                @endforeach
            </div><!-- End .col-md-6 -->
        </div><!-- End .col-md-6 -->
        

        <div class="col-sm-6 col-lg-3 order-lg-last">
            @foreach ($blogs ->skip(2)->take(1) as $blog)
            <div class="banner banner-cat banner-link-anim">
                <a href="{{route('blogs',$blog->slug)}}">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{$blog->title}}">
                </a>

                <div class="banner-content banner-content-top">
                    <h3 class="banner-title">{{$blog->title}}</h3><!-- End .banner-title -->
                    <h4 class="banner-subtitle">{{$blog->short_description}}</h4><!-- End .banner-subtitle -->
                
                </div><!-- End .banner-content -->
            </div><!-- End .banner -->
            @endforeach

            @foreach ($blogs ->skip(3)->take(1) as $blog)
            <div class="banner banner-cat banner-link-anim">
                <a href="{{route('blogs',$blog->slug)}}">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{$blog->title}}">
                </a>

                <div class="banner-content banner-content-top">
                    <h3 class="banner-title">{{$blog->title}}</h3><!-- End .banner-title -->
                    <h4 class="banner-subtitle">{{$blog->short_description}}</h4><!-- End .banner-subtitle -->
                
                </div><!-- End .banner-content -->
            </div><!-- End .banner -->
            @endforeach
        </div><!-- End .col-sm-6 -->

        <div class="col-lg-6">
            <div class="row">
                @foreach ($blogs ->skip(4)->take(1) as $blog)
                <div class="col-sm-6 col-lg-12">
                    <div class="banner banner-cat banner-link-anim">
                        <a href="{{route('blogs',$blog->slug)}}">
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{$blog->title}}">
                        </a>

                        <div class="banner-content">
                            <h3 class="banner-title">{{$blog->title}}</h3><!-- End .banner-title -->
                            <h4 class="banner-subtitle">1{{$blog->short_description}}</h4><!-- End .banner-subtitle -->
                            
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 col-lg-12 -->
                @endforeach
               
            </div><!-- End .row -->
        </div><!-- End .col-lg-6 -->
    </div><!-- End .row -->


</div>


