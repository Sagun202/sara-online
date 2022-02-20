@extends('frontend.layouts.master')

@section('content')
<div class="related-products-slider">
    <div class="related-procuts-heading">
        <p>Wishlisted</p>
    </div>
    <div class="related-swiper-container">
        <div class="swiper-wrapper">
            @foreach ($lists as $list)
            @php($product = $list->product)
            <div class="swiper-slide">
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
                                <a href="javascript:void(0);" onclick="
                                if(confirm('Are you sure want to remove?')){
                                $('#remove_{{ $list->id }}').submit();
                                }
                                " class="btn btn-danger">Remove
                                    <form method="post" id="remove_{{ $list->id }}"
                                        action="{{ route('user.wishlist.remove',$list->id) }}">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </a>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
@endsection

@push('js')

<script>
    var swiper = new Swiper(".related-swiper-container", {
      slidesPerView: 6,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>
@endpush