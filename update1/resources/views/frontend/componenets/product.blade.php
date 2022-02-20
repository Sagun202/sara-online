<a href="{{ route('product.detail',$product->slug) }}">
    <div class="topPro-card">
        <div class="topPro-card-img">
            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->title }}" />
        </div>
        <div class="topPro-card-text">
            <div class="topPro-card-name">
                <p>{{ $product->title }}</p>
            </div>
            <div class="topPro-card-price">
                <p>Rs. {{ $product->price-$product->price*$product->discount/100 }}</p>
            </div>
            <div class="topPro-card-disPrice">
                <p class="before-price">Rs.{{ $product->price }} </p>
                <p class="disPercent">-{{ $product->discount }}%</p>
            </div>
            <div class="topPro-card-category">
                <p>{{ $product->categories->first()->name??'' }}</p>
            </div>
        </div>
    </div>
</a>