


    <div class="super-deal padd" >
      <div class="product-block" style="background-color: white; padding: 10px; border-radius: 20px;" >
         <div class="block-top">
            <h3>
               <strong>
                <h3>{{ $category->name }}</h3>
               </strong>
            </h3>
         
            <div class="seeall">
               <p>
                  <a href="{{ route('product.list','super-products') }}">
                  View More &nbsp; <i class="fa fa-arrow-right"></i>
                  </a>
               </p>
            </div>
         </div>
         <br>
         <div class="owl-carousel catee owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
               <div class="owl-stage" style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                @foreach ($category->products as $product)  
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
   <br>








    
    <script>


var owl = $('.catee');
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
    
    
    
    

  </div>
</div>

    
 
</div>
