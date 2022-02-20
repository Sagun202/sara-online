<div class="index-highlight">
  <div class="index-highlight-products">
    @foreach ($brands as $brand)
    <div class="index-highlight-product-card">
      <a href="{{ route('brand',$brand->slug) }}">
        <div class="highlight-card-img">
          <img src="{{ asset('storage/'.$brand->image) }}" alt="{{ $brand->name }}" />
        </div>
        {{-- <div class="highlight-card-offer">
          <p>Upto 10%</p>
        </div>
        <div class="highlight-card-price">
          <p>Starting from <span>Rs. 200</span></p>
        </div> --}}
        <div class="highlight-card-category">
          <p>{{ $brand->name }}</p>
        </div>
      </a>
    </div>
    @endforeach

  </div>
</div>