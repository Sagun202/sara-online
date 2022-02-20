<div class="product product-4 text-center">
    <figure class="product-media">
   
       <a href="{{ route('product.detail',$product->slug) }}">
       <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}" class="product-image">
       </a>
        <div class="product-action-vertical">
        @livewire('wish-list',['product'=>$product])
       </div>
       
       <!-- End .product-action -->
        <div class="product-action">
          
            @livewire('single-add-to-cart',['product'=>$product])
      
    
       </div>
       <!-- End .product-action -->
    </figure>
    <!-- End .product-media -->

  

    <div class="product-body">
       <h3 class="product-title"> <a href="{{ route('product.detail',$product->slug) }}">{{ Illuminate\Support\Str::limit($product->title,20) }}</a></h3>
       <!-- End .product-title -->
       <div class="product-price" style="display: flex; justify-content: space-between;">
         <p class="discount" style="text-decoration: line-through; color:#001768; font-weight:500">Rs. {{ $product->price-$product->discount }}</p>
         <p style="color: #001768; font-weight:500">Rs.{{ $product->price }}</p>
          
       </div>
       <!-- End .product-price -->
    </div>
    <!-- End .product-body -->
 </div>
