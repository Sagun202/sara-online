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