@extends('frontend.layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/flexslider.css" />
<style>
    .selected {
     
        font-weight: 900;
        color: red !important
        

    }

    .disableClass {
        border: 1px solid dotted !important;
    }
</style>

@endpush
@section('content')







<main class="main" style="background:white;">
    
    <br>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical" >
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="main" class="magnifiedImg"  src="{{ asset('storage/'.$product->thumbnail) }}" data-zoom-image="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}">

                               
                                </figure><!-- End .product-main-image -->

                                <div  id="product-zoom-gallery" class="product-image-gallery">

                                    
                                <div>
                                    @foreach ($product->images as $image)
                                    <img onclick="document.getElementById('main').src='{{ asset('storage/'.$image) }}'"   src="{{ asset('storage/'.$image) }}" alt="product side">
                                    @endforeach
                                    <img onclick="document.getElementById('main').src='{{ asset('storage/'.$product->thumbnail) }}'"    src="{{ asset('storage/'.$product->thumbnail) }}" alt="product side">
                                </div>
                          
                                
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->
                    @livewire('product-detail',['product'=>$product])
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">( {{ count($product->reviews) }} Reviews )</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            {!!$product->description!!}
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                  
                    
                       
                        @livewire('review',['product'=>$product])
                       
                       <!-- End .reviews -->
                   <!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

          
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main>







<div class="container">
    <!-- Breadcrumbs -->
  
    <!-- Breadcrumbs End -->
  
          
   
<style>
    #tow { display: none; }
</style>

<script>
    function showDiv() {
    div = document.getElementById('tow');
    div.style.display = "block";
}
</script>

<script>
document.getElementById("tow2").addEventListener("click", myFunction);

function myFunction() {
    
      div1 = document.getElementById('help1');
    div1.style.display = "none";

}
</script>


                                    
                                    
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    

    <div class="super-deal " >
        <div class="product-block" style="background-color: white; padding: 10px; border-radius: 5px;" >
          

            <div class="row" style="align-content: center; align-items:center; justify-content: center;  ">
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>

            <div class="col-2">
               <center>
                  <button class=" rounded-pill btn-primary" style="background: #001768; color:white; font-size:20px; font-weight:600; ">Related Product</button>
               </center>
               
            </div>
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>
         </div>

           <br>
           <div class="owl-carousel relate owl-theme owl-loaded owl-drag">
              <div class="owl-stage-outer">
                 <div class="owl-stage" style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                  @foreach ($related as $relate)  
                  <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                      
                       <div class="item">
                        {{ FrontEndHandler::getProductCard($relate) }}
                       </div>
                     
                    </div>
                    @endforeach
                
                 </div>
              </div>
           </div>
        </div>
     </div>
     <br>
  

  
  <script>
    var owl = $('.relate');
    owl.owlCarousel({
     
        loop:true,
          dots: false,
        margin:10,
        autoplayHoverPause:true,
        responsive: {
            0:{
              items: 3,
               loop:true
            },
            480:{
              items: 3,
               loop:true
            },
            769:{
              items: 5,
              margin:30,
               loop:true
            }
        }
    });
    
    
        
  </script>



    
</div>

<script>

    /*Size is  set in pixels... supports being written as: '250px' */

var magnifierSize = 250;



/*How many times magnification of image on page.*/

var magnification = 2;



function magnifier() {



this.magnifyImg = function(ptr, magnification, magnifierSize) {

var $pointer;

if (typeof ptr == "string") {

  $pointer = $(ptr);

} else if (typeof ptr == "object") {

  $pointer = ptr;

}



if(!($pointer.is('img'))){

  alert('Object must be image.');

  return false;

}



magnification = +(magnification);



$pointer.hover(function() {

  $(this).css('cursor', 'none');

  $('.magnify').show();

  //Setting some variables for later use

  var width = $(this).width();

  var height = $(this).height();

  var src = $(this).attr('src');

  var imagePos = $(this).offset();

  var image = $(this);



  if (magnifierSize == undefined) {

    magnifierSize = '150px';

  }



  $('.magnify').css({

    'background-size': width * magnification + 'px ' + height * magnification + "px",

    'background-image': 'url("' + src + '")',

    'width': magnifierSize,

    'height': magnifierSize

  });



  //Setting a few more...

  var magnifyOffset = +($('.magnify').width() / 2);

  var rightSide = +(imagePos.left + $(this).width());

  var bottomSide = +(imagePos.top + $(this).height());



  $(document).mousemove(function(e) {

    if (e.pageX < +(imagePos.left - magnifyOffset / 6) || e.pageX > +(rightSide + magnifyOffset / 6) || e.pageY < +(imagePos.top - magnifyOffset / 6) || e.pageY > +(bottomSide + magnifyOffset / 6)) {

      $('.magnify').hide();

      $(document).unbind('mousemove');

    }

    var backgroundPos = "" - ((e.pageX - imagePos.left) * magnification - magnifyOffset) + "px " + -((e.pageY - imagePos.top) * magnification - magnifyOffset) + "px";

    $('.magnify').css({

      'left': e.pageX - magnifyOffset,

      'top': e.pageY - magnifyOffset,

      'background-position': backgroundPos

    });

  });

}, function() {



});

};



this.init = function() {

$('body').prepend('<div class="magnify"></div>');

}



return this.init();

}



var magnify = new magnifier();

magnify.magnifyImg('img'+'.magnifiedImg', magnification, magnifierSize);



</script>
<style>
    .magnify {
 border: 2px solid black;
 position: absolute;
 z-index: 20;
 background-repeat: no-repeat;
 background-color: white;
 box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
 display: none;
 cursor: none;
}
</style>


@endsection
@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.flexslider.js"></script>

<!--cloud-zoom js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/cloud-zoom.js"></script>

@endpush