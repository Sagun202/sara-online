
<div class="row" style="align-content: center; align-items:center; justify-content: center;  ">
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>

            <div class="col-2">
               <center>
                  <button class=" rounded-pill btn-primary" style="background: #001768; color:white; font-size:20px; font-weight:600; "> Top  DEALS</button>
               </center>
               
            </div>
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>
         </div>
    <div class="Top-deal padd" >
        <div class="product-block" style="background-color: white; padding: 10px; border-radius: 5px;" >
          
              
           
              <div style="float:right" class="seeall">
                 <p>
                    <a href="{{ route('product.list','top-products') }}">
                    View More &nbsp; <i class="fa fa-arrow-right"></i>
                    </a>
                 </p>
              </div>
         
           <br>
           <div class="owl-carousel Top owl-theme owl-loaded owl-drag">
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
     <br>
  
  
  <script>
    var owl = $('.Top');
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
              items: 6,
              margin:30,
               loop:true
            }
        }
    });
    
    
        
  </script>