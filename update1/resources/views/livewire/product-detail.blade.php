<div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
    <div class="product-name">
        <h1>{{ $title }}</h1>
    </div>
    <div class="price-box">
        <p class="special-price">
            <span class="price-label">Special Price</span>
            <span class="price"> Rs. {{ $price-$price*$product->discount/100 }}
            </span>
        </p>
        <p class="old-price">
            <span class="price-label">Regular Price:</span>
            <span class="price"> Rs. {{ $price }} </span>
        </p>
    </div>
    <div class="ratings">
        <div class="rating">
            @php($avg = $product->reviews->avg('rate'))

            @for($i=0;$i<$avg; $i++) <i class="fa fa-star"></i>
                @endfor
                @for($i=0;$i<5-$avg;$i++) <i class="fa fa-star-o"></i>
                    @endfor
        </div>
        <p class="rating-links">
            <a href="#"> {{ count($product->reviews) }} Review(s)</a>
            <span class="separator">|</span>
            <a href="#reviews">Add Your Review</a>
        </p>
        <p class="availability in-stock pull-right">
            Availability: @if($product->quantity>0)<span>In Stock</span> @else <span
                style="background-color: red; color:white;">Out of
                Stock</span>@endif
        </p>
    </div>
    <div class="short-description">
        <h2>Quick Overview</h2>
        {!! $product->short_description !!}
    </div>
    <div class="product-color-size-area">
        <!-- <div class="color-area">
                        <h2 class="saider-bar-title">Color</h2>
                        <div class="color">
                            <ul>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div> -->
        @if($has_variation)
        @foreach ($modifyVariations as $key => $attribute)

        <div class="size-area">
            <h2 class="saider-bar-title">{{ $attribute['name'] }}</h2>
            <div class="size">
                <ul>
                    @foreach ($attribute['values'] as $variation)
                    @php($class = 'highlight_'.$attribute['id'].'_'.$variation['id'])
                    <li><a class="@if(in_array($class,$hightlightClasses))selected @else disableClass @endif"
                            @if(!in_array($class,$hightlightClasses))
                            wire:click="select({{ $attribute['id'] }},{{ $variation['id'] }})" @endif
                            href="javascript:void(0)">{{ $variation['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="product-variation">
        <form action="#" method="post">
            <div class="cart-plus-minus">
                <label for="qty">Quantity:</label>
                <div class="numbers-row">
                    <div wire:click="decreaseQty" class="dec qtybutton">
                        <i class="fa fa-minus">&nbsp;</i>
                    </div>
                    <input type="text" class="qty" title="Qty" wire:model="quantity" id="qty" name="qty" disabled />
                    <div wire:click="increaseQty" class="inc qtybutton">
                        <i class="fa fa-plus">&nbsp;</i>
                    </div>
                </div>
            </div>
            <button class="button pro-add-to-cart" title="Add to Cart" wire:click="addToCart" type="button">
                <span><i class="fa fa-shopping-basket"></i> Add to
                    Cart</span>
            </button>
        </form>
    </div>
    <div class="product-cart-option">
        <ul>
            @livewire('wish-list',['product'=>$product])
        </ul>
    </div>

    @if($product->tags)
    <div class="pro-tags">
        <div class="pro-tags-title">Tags:</div>
        @foreach (explode(',',$product->tags) as $tag)
        <a href="#">{{ $tag }}</a>
        @endforeach
    </div>
    @endif
    <div class="share-box">
        <div class="title">Share in social media</div>
        <div class="socials-box">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.detail',$product->slug) }}"
                target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ route('product.detail',$product->slug) }}"
                target="_blank"><i class="fa fa-twitter"></i></a>

            <a href="https://www.linkedin.com/cws/share?url={{ route('product.detail',$product->slug) }}"
                target="_blank"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>