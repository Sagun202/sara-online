<div class="row">
    <aside class="sidebar col-sm-4 col-md-3 col-xs-12">
        {{-- <div class="block category-sidebar">
            <div class="sidebar-title">
                <h3>Categories</h3>
            </div>
            <ul class="product-categories">
                <li class="cat-item current-cat cat-parent"><a href="shop_grid.html">Women</a>
                    <ul class="children">
                        <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Accessories</a>
                            <ul class="children">
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Dresses</a></li>
                                <li class="cat-item cat-parent"><a href="shop_grid.html"><i
                                            class="fa fa-angle-right"></i>&nbsp; Handbags</a>
                                    <ul class="children">
                                        <li class="cat-item"><a href="shop_grid.html"><i
                                                    class="fa fa-angle-right"></i>&nbsp; Beaded
                                                Handbags</a></li>
                                        <li class="cat-item"><a href="shop_grid.html"><i
                                                    class="fa fa-angle-right"></i>&nbsp; Sling bag</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Handbags</a>
                            <ul class="children">
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        backpack</a></li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Beaded Handbags</a>
                                </li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Fabric Handbags</a>
                                </li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Sling bag</a></li>
                            </ul>
                        </li>
                        <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Jewellery</a> </li>
                        <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Swimwear</a> </li>
                    </ul>
                </li>
                <li class="cat-item cat-parent"><a href="shop_grid.html">Men</a>
                    <ul class="children">
                        <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Dresses</a>
                            <ul class="children">
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Casual</a></li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Designer</a></li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Evening</a></li>
                                <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                        Hoodies</a></li>
                            </ul>
                        </li>
                        <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Jackets</a> </li>
                        <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp;
                                Shoes</a> </li>
                    </ul>
                </li>
                <li class="cat-item"><a href="shop_grid.html">Electronics</a></li>
                <li class="cat-item"><a href="shop_grid.html">Furniture</a></li>
                <li class="cat-item"><a href="shop_grid.html">KItchen</a></li>
            </ul>
        </div> --}}
        <div class="block shop-by-side">
            <div class="sidebar-bar-title">
                <h3>Shop By</h3>
            </div>
            <div class="block-content">
                <div class="layered-Category">
                    <h2 class="saider-bar-title">Categories</h2>
                    <div class="layered-content">
                        <ul class="check-box-list">
                            @foreach ($categories as $cat)
                            <li>
                                <input type="checkbox" wire:model="selectedCategories" name="categories[]"
                                    id="category_{{ $cat->id }}" value="{{ $cat->id }}">
                                <label for="category_{{ $cat->id }}"> <span class="button"></span> {{ $cat->name }}<span
                                        class="count">({{ count($cat->products) }})</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="manufacturer-area">
                    <h2 class="saider-bar-title">Manufacturer</h2>
                    <div class="saide-bar-menu">
                        <ul>

                            <li>
                                <input type="checkbox" id="brand_{{ $brand->id }}" value="{{ $brand->id }}" checked
                                    disabled>
                                <label for="brand_{{ $brand->id }}"> <span class="button"></span> {{ $brand->name }}
                                </label>
                            </li>


                        </ul>
                    </div>
                </div>
                {{-- <div class="size-area">
                    <h2 class="saider-bar-title">Size</h2>
                    <div class="size">
                        <ul>
                            <li><a href="#">S</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">XL</a></li>
                            <li><a href="#">XXL</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="block product-price-range ">
            <div class="sidebar-bar-title">
                <h3>Price</h3>
            </div>
            <div class="block-content">
                <div class="slider-range">
                    {{-- <div data-label-reasult="Range:" data-min="0" data-max="500" data-unit="$"
                        class="slider-range-price" data-value-min="50" data-value-max="350"></div> --}}
                    <div class="amount-range-price">Range: Rs.{{ $priceMin }} - Rs.{{ $priceMax }}</div>
                    <ul class="check-box-list">
                        <li>
                            <input type="radio" wire:click="setPrice(0,1000)" id="p1" name="cc" />
                            <label for="p1"> <span class="button"></span> Rs.0 - Rs.1000
                            </label>
                        </li>
                        <li>
                            <input type="radio" wire:click="setPrice(1000,5000)" id="p2" name="cc" />
                            <label for="p2"> <span class="button"></span> Rs.1000- Rs.5000
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="p3" name="cc" wire:click="setPrice(5000,1000000)" />
                            <label for="p3"> <span class="button"></span> Rs.5000 +
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <div class="col-main col-sm-8 col-md-9 col-xs-12">
        <div class="shop-inner">
            <div class="page-title">
                <h2>{{ $brand->name }}</h2>
            </div>
            <div class="toolbar">

                <div class="sorter">
                    <div class="short-by">
                        <label>Sort By:</label>
                        <select wire:model="sortBy">
                            <option value="">Sort By</option>
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="low">Low to High Price</option>
                            <option value="high">High to Low Price</option>

                        </select>
                    </div>
                    <div class="short-by page">
                        <label>Show:</label>
                        <select wire:model="paginate">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="product-grid-area">
                <ul class="products-grid">
                    @forelse ($productss as $product)

                    <li class="item col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
                        {{ FrontEndHandler::getProductCard($product) }}
                    </li>
                    @empty
                    <h1>Not Found!! Try another one.</h1>
                    @endforelse

                </ul>
            </div>
            <div class="pagination-area">
                {{ $productss->links() }}

            </div>
        </div>
    </div>

</div>