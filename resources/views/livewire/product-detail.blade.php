




   <div class="col-md-6">
    <div class="product-details product-details-centered">
      <h1 class="product-title">  <strong style="color: #b229d0; font-size:40px;">{{ $title }} </strong></h1>  <!-- End .product-title -->



        <div class="ratings-container">
            <div class="ratings">
                <div  style="width: 80%;"> 
                      @php($avg = $product->reviews->avg('rate'))
    
                    @for($i=0;$i<$avg; $i++) <i class="fa fa-star"></i>
                        @endfor
                        @for($i=0;$i<5-$avg;$i++) <i class="fa fa-star-o"></i>
                            @endfor</div><!-- End .ratings-val -->
            </div><!-- End .ratings -->
            
            <a class="ratings-text" href="#product-review-link" id="review-link">( {{ count($product->reviews) }} Reviews )</a>
           
        </div><!-- End .rating-container -->
        <p class="availability in-stock pull-right">
            Availability: @if($product->quantity>0)<span>In Stock</span> @else <span
                style="background-color: red; color:white;">Out of
                Stock</span>@endif
        </p>

        <div class="product-price">
            Rs. {{ $product->price-$product->discount }}
        </div><!-- End .product-price -->

        <div class="product-content">
            <p>{!! $product->short_description !!}</p>
        </div><!-- End .product-content -->



        @if($has_variation)
        @foreach ($modifyVariations as $key => $attribute)

        <div class="details-filter details-row-size">
            <a><h4 style="color: red" class="saider-bar-title ">{{ $attribute['name'] }} :</h4></a> 

            <div class="size">
                <div>
                    @foreach ($attribute['values'] as $variation)
                    @php($class = 'highlight_'.$attribute['id'].'_'.$variation['id'])
                    <button style="background: white; border-radius:8px; box-shadow:1px 1px 1px 1px {{ $variation['name'] }};"   class="  @if(in_array($class,$hightlightClasses))selected @else disableClass @endif"
                            @if(!in_array($class,$hightlightClasses))
                            wire:click="select({{ $attribute['id'] }},{{ $variation['id'] }})" @endif
                            href="javascript:void(0)">{{ $variation['name'] }}</button>&nbsp;
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
        @endif


<br>

        <div class="product-details-action">
            <div class="details-action-col">
                <div class="product-details-quantity">
                    <form action="#" method="post">
                        <div class="cart-plus-minus" >
                            <label for="qty">Quantity:</label>
                            <div class="numbers-row" style="display:flex">
                                <div wire:click="decreaseQty" class="dec qtybutton">
                                    <i class="fa fa-minus">&nbsp;</i>
                                </div>
                                <input style="width: 50px" type="text" class="qty" title="Qty" wire:model="quantity" id="qty" name="qty" disabled />
                                <div wire:click="increaseQty" class="inc qtybutton">
                                    <i class="fa fa-plus">&nbsp;</i>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div><!-- End .product-details-quantity -->
                <button style="margin-top: 30px" class="btn-product btn-cart" title="Add to Cart" wire:click="addToCart" type="button">

                    <span> Add to
                        Cart</span>
                </button>
            <div style="margin-left: 10px;
            margin-top: 30px;">   
                @livewire('wish-list',['product'=>$product]) </div>
              
        
            </div><!-- End .details-action-col -->

           
        </div><!-- End .product-details-action -->


    </div><!-- End .product-details -->
</div









