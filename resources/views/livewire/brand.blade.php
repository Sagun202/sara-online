






<br>
<div class="row">
    <div class="col-lg-9">
        <div class="toolbox">
            <div class="col-xs-12">
                <ul>
                   
                    <li><strong></strong></li>
                </ul>
            </div>

            <div class="toolbox-right">
                <div class="short-by page">
                    <label>Show:</label>
                    <select wire:model="paginate">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                    </select>
                </div>
            &nbsp;
                <div class="toolbox-sort">
                  
                    <label for="sortby">Sort by:</label>
                    <div class="select-custom">
                        <select wire:model="sortBy" name="sortby" id="sortby" class="form-control">
                            <option value="">Sort By</option>
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="low">Low to High Price</option>
                            <option value="high">High to Low Price</option>
                        </select>
                    </div>
                </div><!-- End .toolbox-sort -->
           
            </div><!-- End .toolbox-right -->
        </div><!-- End .toolbox -->

        <div class="products mb-3">
            <div class="row justify-content-center">

                @forelse ($productss as $product)
                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                

                    
                        {{ FrontEndHandler::getProductCard($product) }}
                  
                
                   
                </div>
                @empty
                <h1>Not Found!! Try another one.</h1>
                @endforelse
              
            </div><!-- End .row -->
        </div><!-- End .products -->

        <div class="pagination-area">

            {{ $productss->links() }}

        </div>
        {{-- <nav aria-label="Page navigation">

            
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item-total">of 6</li>
                <li class="page-item">
                    <a class="page-link page-link-next" href="#" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            </ul>
        </nav> --}}
    </div><!-- End .col-lg-9 -->
    <aside class="col-lg-3 order-lg-first" style="background: white">
        <div class="sidebar sidebar-shop">
            <div class="widget widget-clean">
                <label>Filters:</label>
                <a href="#" class="sidebar-filter-clear">Clean All</a>
            </div><!-- End .widget widget-clean -->

            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                        Category
                    </a>
                </h3><!-- End .widget-title -->





                
              

                <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                        <div class="filter-items filter-items-count">
                            @foreach ($categories as $cat)
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="{{ $cat->id }}" id="{{ $cat->id }}">
                                    <label class="custom-control-label" for="category_{{ $cat->id }}"> {{ $cat->name }}</label>
                                </div>
                                <span style="background: transparent" class="item-count">({{ count($cat->products) }})</span>
                            </div><!-- End .filter-item -->
                            @endforeach
                         
                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->

            {{-- <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                       size
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-2">
                    <div class="widget-body">
                        <div class="filter-items">
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                    <label class="custom-control-label" for="size-1">XS</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                    <label class="custom-control-label" for="size-2">S</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="size-3">
                                    <label class="custom-control-label" for="size-3">M</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="size-4">
                                    <label class="custom-control-label" for="size-4">L</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-5">
                                    <label class="custom-control-label" for="size-5">XL</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-6">
                                    <label class="custom-control-label" for="size-6">XXL</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->
                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div> --}}
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                     price range
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-2">
                    <div class="widget-body">
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
                    </div><!-- End .widget-body -->
                </div>
            </div>
            {{-- <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                        Colour
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-3">
                    <div class="widget-body">
                        <div class="filter-colors">
                            <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                            <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                            <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                        </div><!-- End .filter-colors -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div> --}}

   

       
        </div><!-- End .sidebar sidebar-shop -->
    </aside><!-- End .col-lg-3 -->
</div>


<br>

