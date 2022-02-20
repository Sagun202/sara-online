<div class="index-categories">
  <div class="container-fluid">
    <div class="index-categories-heading">
      <p>Explore our categories</p>
      <a href="category.html">See all <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    <div class="index-categories-content">
      <ul>
        @foreach ($categories as $category)
        <li>
          <a href="{{ route('category',$category->slug) }}">
            <div class="index-categories-cards">
              <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" />
              <p>{{ $category->name }}</p>
            </div>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>