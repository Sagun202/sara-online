<div class="index-banner1">
  <div class="index-banner1-text">
    <h3 class="index-banner1-heading">
      {{ $ads->title }}
    </h3>
    <p>{!! $ads->description !!}</p>
    <button class="index-banner1-button" target="_blank" href="{{ $ads->link }}">
      <p>{{ $ads->button_text }}</p>
      <img src="{{ asset('frontend') }}/images/click-svg.svg" alt="" />
    </button>
    <!-- <a href="#">
      <p>
        <img src="images/click-svg.svg" alt="">
      </p>
    </a> -->
  </div>

  <div class="index-banner1-img">
    <img src="{{ asset('storage/'.$ads->image) }}" alt="{{ $ads->title }}" />
  </div>
</div>