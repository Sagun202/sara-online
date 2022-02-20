<div class="main-slideshow">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <img src="{{ asset('storage/'.$slider->image) }}" alt="{{ $slider->title }}" />
            </div>
            @endforeach

        </div>
        <!-- Add Arrows -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>