
            
         <div class="row" style="align-content: center; align-items:center; justify-content: center;  ">
            <div class="col-3">
               <hr style="  background: #001768; height:2px;">
            </div>

            <div class="col-2">
               <center>
                 <a  href="{{ route('categories') }}">  <button class=" rounded-pill btn-primary" style="background: #001768; color; white;font-size:20px; font-weight:600;"> POPULAR CATEGORIES </button></a>
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
               @foreach ($categories as $count=> $category)
                @if($count<12)
               <div class="grid-item">
                  <main class="cat-item">
                     <a href="{{ route('category',$category->slug) }}">
                     <img src="{{ asset('storage/'.$category->image) }}" alt="">
                     </a>
                  </main>
                  <center >
                     <h3 class="product-title">{{  Illuminate\Support\Str::limit($category->name, 15) }}</h3>

                  </center>
               </div>
               @endif
               @endforeach
               
               
               
               <br>
   
            </div>
         </div>
       

         <br>