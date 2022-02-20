<div class="index-featured-products">
  <div class="container-fluid">
    <div class="index-featured-products-heading">
      <p>Our Featured Products</p>
      <a href="{{ route('product.list','featured-products') }}">See all <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    <div class="featured-swiper-container">
      <div class="swiper-wrapper">
        @foreach ($products as $product)
        <div class="swiper-slide">
          {{ FrontEndHandler::getProductCard($product) }}
        </div>
        @endforeach
        <div class="swiper-slide">
          <a href="product.html">
            <div class="topPro-card topPro-sell-card">
              <div class="topPro-card-img">
                <img src="{{ asset('frontend') }}/images/click-svg.svg" alt="" />
              </div>
              <div class="topPro-card-text">
                <div class="topPro-card-name">
                  <p>Do u want to sell your items?</p>
                </div>
                <div class="topPro-sell-text">
                  <p>
                    If yes?<br />
                    Then <span>Click here</span>
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</div>