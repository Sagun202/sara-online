
            <br>
         <div class="row" style="align-content: center; align-items:center; justify-content: center;  ">
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>

            <div class="col-2">
               <center>
                  <button class=" rounded-pill btn-primary" style="background: #001768; color:white; font-size:20px; font-weight:600;"> OUR BRANDS</button>  
               </center> 
            </div>
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>
         </div>
         <br>
         <div class="padd">
            <br>
            <div class="grid-section ">
                @foreach ($brands as $count=> $brand)
                @if($count<12)
               <div class="grid-item">
                         <a href="{{ route('brand',$brand->slug) }}">
                  <main class="cat-item">
                     <img src="{{ asset('storage/'.$brand->image) }}" alt="{{$brand->name}}">
                  </main>
                         </a>
                  <center >
                     <h3 class="product-title">{{$brand->name}}</h3>

                  </center>
               </div>
               @endif
                @endforeach
               
              
               
               <br>
   
            </div>
         </div>
       

         <br>