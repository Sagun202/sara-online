<div class="index-top-products">
  <div class="container-fluid">
    <div class="index-top-products-heading">
      <p>Our most popular Product</p>
      <a href="{{ route('product.list','top-products') }}">See all <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    
    
    
    
    
    
    <div class="owl-carousel most owl-theme owl-loaded owl-drag">
            
       <div class="owl-stage-outer">
         
         <div class="owl-stage" style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
             @foreach ($products as $product)
           <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
               <div class="item">
          
 
          {{ FrontEndHandler::getProductCard($product) }}

     
            </div>
         </div>
            @endforeach
         
      
         
           
  </div>
  
</div>
</div>

    
    
    
    

  </div>
</div>
  
    <script>


var owl = $('.most');
owl.owlCarousel({
 
    loop:true,
      dots: false,
    margin:10,
    autoplay:true,
    autoplayTimeout:2500,
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
          items: 6,
           loop:true
        }
    }
});


    </script>
    