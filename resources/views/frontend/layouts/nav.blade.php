@php($site = Theme::siteSetup())
@php($categories = FrontEndHandler::getCategoryTree())
<header class="header header-10 header-intro-clearance">
    <div class="header-top">
        <div class="container-fluid">
            <div class="header-left">
           

                <ul>
                    <li><a style="color: white" href="tel:#">winter offer <i class="fa fa-sale"></i></a></li>
                </ul>
            </div><!-- End .header-left -->
            <div class="header-middle" style="margin-left: auto">
           

                <ul>
                    <li><a style="color: white" href="tel:#">Free shipping nepalwide <i class="fa fa-sale"></i></a></li>
                </ul>
            </div>

            <div class="header-right">
                <div class="dropdown show">
                    <a style="color: white" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     My account <i class="fa fa-user"></i>
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @auth
                        <a class="dropdown-item" href="{{ (auth()->user()->hasRole('user'))? route('user.dashboard'): route('dashboard') }}">Account</a>
                      @else
                      <a class="dropdown-item" href="#signin-modal" data-toggle="modal">login</a>
                      @endauth
        
                      <a class="dropdown-item" href="{{route('cart')}}">cart</a>
                      <a class="dropdown-item" href="{{route('user.wishlists')}}">wishlist</a>
                
                      @auth
                      <form method="POST" action="{{ route('logout') }}" class="logout">
                          @csrf
                      </form>
                      <a class="dropdown-item"  onclick="event.preventDefault();
                      $('.logout').submit();">logout</a>
                    
                     
                      @endauth
                    </div>
                  </div>
            </div><!-- End .header-right -->
        </div><!-- End .container-fluid -->
    </div>

    <div class="header-middle">
        <div class="contain padd row">
            <div class="col-2">
                <button onclick="myFunction();" class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="{{route('index')}}" class="logo">
                    <img src="{{asset('storage/'.$site->logo)}}" >
                </a>
            </div><!-- End .header-left -->

            <div class="col-7">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Categories</option>

                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}} </option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                            <button style="background: #b229d0; color:white"  class="btn " type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">
                <div class="header-dropdown-link">
                   

                  

                    <div class="dropdown cart-dropdown">
                        <a href="{{route('cart')}}">
                            @livewire('cart-counter')
                        </a>

                    </div><!-- End .cart-dropdown -->
                </div>
                <a href="{{route('user.wishlists')}}" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <span class="wishlist-txt">Wishlist</span>
                </a>

                @livewire('login')

                
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->







    <div class="header-bottom sticky-header" >
        <div class="row padd">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories 
                    </a>
        
                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows sf-js-enabled" style="touch-action: pan-y;">
                                @php($categories = FrontEndHandler::getCategoryTree())
                              @foreach ($categories as $category)
                              <li class="item-lead"><a href="{{route('category',$category->slug)}}">{{$category->name}}</a></li>
                              @endforeach
                                    
                          
                                
                               
                               
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div>
    
            <div class="header-center"  >
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        @foreach ($categories as $category)

                                <li class="item-lead"><a href="{{route('category',$category->slug)}}">{{$category->name}}</a></li>

                        @endforeach
                               <li class="item-lead"><a href="{{route('blog_list')}}">Blogs</a></li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
    
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
            </div>
    
        </div>
    
                   
    </div>


</header><!-- End .header -->

























<script>
 function myFunction() {
  var element = document.getElementById("myDIV");
  element.classList.toggle("mmenu-active");
}



</script>