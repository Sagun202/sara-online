<header>
    <div class="header-container">
        <div class="header-top">
            <div class="container-fluid">
                @php($site = Theme::siteSetup())
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <!-- Default Welcome Message -->
                        <span class="phone  hidden-xs hidden-sm">Call Us: {{ $site->phone }}</span>
                        <!-- Language &amp; Currency wrapper -->
                    </div>

                    <!-- top links -->
                    <div class="headerlinkmenu col-md-4 col-sm-8 col-xs-12">
                        <ul class="links">
                            <li class="">
                                <a title="Help Center" class="sell-header-animation"
                                    href="{{ route('sell-us') }}"><span>Sell On
                                        {{ $site->name }}</span></a>
                            </li>

                            <!-- Login and Register Modal -->
                            <!-- Modal Ends -->
                            <li>
                                <div class="dropdown">
                                    <div class="dropdown">
                                        <a class="current-open" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" href="#"><span>My Account</span>
                                            <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                @auth
                                                <a style="color:black !important;"
                                                    href="{{ (auth()->user()->hasRole('user'))? route('user.dashboard'): route('dashboard') }}">My
                                                    Account
                                                </a>
                                                @else
                                                <a style="color:black !important;" href="{{ route('login') }}">Account
                                                </a>
                                                @endif
                                            </li>
                                            <li><a style="color:black !important;"
                                                    href="{{ route('user.wishlists') }}">Wishlist</a>
                                            </li>
                                            <li><a style="color:black !important;"
                                                    href="{{ route('user.dashboard') }}">Order Tracking</a></li>
                                            <li><a style="color:black !important;" href="{{ route('about') }}">About
                                                    us</a>
                                            </li>
                                            <li class="divider"></li>
                                            @auth
                                            <form method="POST" action="{{ route('logout') }}" class="logout">
                                                @csrf
                                            </form>
                                            <li><a style="color:black !important;" onclick="event.preventDefault();
                                                $('.logout').submit();">Log out</a></li>
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a title="Help center" href="{{ route('help') }}"><span>Help Center</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1 col-sm-2 col-xs-12 jtv-logo-block" style="display: flex; align-items: center;">
                        <div class="mm-toggle-wrap">
                            <div class="mm-toggle">
                                <i class="fa fa-align-justify"></i>
                            </div>
                            <span class="mm-label hidden">Categories</span>
                        </div>

                        <div class="logo">
                            <a title="{{ $site->name }}" href="{{ route('index') }}"><img alt="{{ $site->name }}"
                                    title="{{ $site->name }}" src="{{ asset('storage/'.$site->logo) }}" /></a>
                        </div>

                        <div class="hiddenusers">
                            <div class="inner-right-cart">
                                <img src="{{ asset('frontend') }}/images/1177568.svg" title="Login" href="#"
                                    data-toggle="modal" data-target="#login-register-modal" style="width: 26px;" />
                            </div>
                            <!-- Login and Register Modal -->
                            {{-- <div class="modal fade  " id="login-register-modal" tabindex="-1" role="dialog"
                                aria-labelledby="demoModal" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered " role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close light" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="login-regster-modal-logo ">
                                            <img src="" alt="" />
                                        </div>

                                        <div class="modal-body">
                                            <form class="px-sm-4 py-sm-4 login-modal-form">
                                                <div class="form-group">
                                                    <label for="login-modal-username">Username</label>
                                                    <input type="text" class="form-control" id="login-modal-username"
                                                        aria-describedby="textHelp" placeholder="Enter your username" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="login-modal-password">Password</label>
                                                    <input type="email" class="form-control" id="login-modal-username"
                                                        aria-describedby="emailHelp"
                                                        placeholder="Enter your password" />
                                                </div>

                                                <div class="login-form-modal-openRegister">
                                                    <button type="submit" class="btn btn-cstm-danger btn-cta btn-block"
                                                        data-dismiss="modal" aria-label="Close">
                                                        Login
                                                    </button>
                                                    <p id="acc-register" class="form-text text-muted">
                                                        Dont have an account?
                                                    </p>
                                                    <a class="register-form-open">
                                                        Register Your account
                                                    </a>
                                                </div>
                                            </form>
                                            <form class="register-modal-form">
                                                <div class="form-group">
                                                    <label for="register-modal-fullname">Full Name</label>
                                                    <input type="text" class="form-control" id="register-modal-fullname"
                                                        aria-describedby="textHelp"
                                                        placeholder="Enter your full name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="register-modal-username">Username</label>
                                                    <input type="text" class="form-control" id="register-modal-fullname"
                                                        aria-describedby="textHelp" placeholder="Enter your username" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="register-modal-email">Email</label>
                                                    <input type="email" class="form-control" id="register-modal-email"
                                                        aria-describedby="textHelp" placeholder="Enter your email" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="register-modal-password">Password</label>
                                                    <input type="text" class="form-control" id="register-modal-fullname"
                                                        aria-describedby="textHelp" placeholder="Enter your email" />
                                                </div>
                                                <div class="login-form-modal-openLogin">
                                                    <button type="submit" class="btn btn-cstm-danger btn-cta btn-block"
                                                        data-dismiss="modal" aria-label="Close">
                                                        Register
                                                    </button>
                                                    <p id="acc-register" class="form-text text-muted">
                                                        Already a member?
                                                    </p>
                                                    <a class="login-form-open">
                                                        Login into you account
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="hiddencart">

                            <img src="{{ asset('frontend') }}/images/cart.svg" style="width: 26px;" />

                        </div>


                    </div>
                    <div class="col-md-8 col-sm-7 col-xs-12">
                        <div class="top-search">
                            <div id="search">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for product..."
                                            name="search" />
                                        <button>
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 header-inner-right headergone">
                        <div class="col-sm-5">
                            <div class="inner-right-cart">
                                <img src="{{ asset('frontend') }}/images/1177568.svg" />
                                @livewire('login',['currentRouteName'=>url()->current()])
                            </div>

                        </div>

                        <div class="col-sm-5">
                            <a href="{{ route('cart') }}">
                                @livewire('cart-counter')
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('user.wishlists') }}">
                                <img src="{{ asset('frontend') }}/images/like.svg" style="width:100px" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<nav>
    @php($categories = FrontEndHandler::getCategoryTree())
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-1 mega-container">
                <div class="navleft-container">
                    <div class="mega-menu-title hidden-xs">
                        <h3><span class="hidden-sm">All Categories</span></h3>
                    </div>
                    <!-- Shop by category -->
                    <div class="mega-menu-category">
                        <ul class="nav">
                            @foreach ($categories as $parent)
                            <li>
                                <a href="#">{{ $parent->name }}</a>
                                <div class="wrap-popup">
                                    <div class="popup">
                                        <div class="row">
                                            @foreach ($parent->allChildrens as $child)
                                            <div class="col-md-4 col-sm-6">
                                                <h3>{{ $child->name }}</h3>
                                                <ul class="nav">
                                                    @foreach ($child->allChildrens as $grand)
                                                    <li>
                                                        <a href="{{ route('category',$child->slug) }}">{{ $grand->name
                                                            }}</a>
                                                    </li>

                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endforeach

                                            {{-- <div class="col-md-4 col-sm-6 has-sep">
                                                <h3>Kids</h3>
                                                <ul class="nav">
                                                    <li><a href="shop_grid.html">Jewellery</a></li>
                                                    <li><a href="shop_grid.html">Sunglasses</a></li>
                                                    <li><a href="shop_grid.html">Tanks</a></li>
                                                    <li><a href="shop_grid.html">Tunics</a></li>
                                                </ul>
                                                <br />
                                                <h3>Accessories</h3>
                                                <ul class="nav">
                                                    <li>
                                                        <a href="shop_grid.html">Bags and Purces</a>
                                                    </li>
                                                    <li><a href="shop_grid.html">Belts</a></li>
                                                    <li><a href="shop_grid.html">Scarves</a></li>
                                                    <li><a href="shop_grid.html">Gloves</a></li>
                                                    <li>
                                                        <a href="shop_grid.html">Hair Accessories</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 has-sep hidden-sm">
                                                <div class="custom-menu-right">
                                                    <div class="box-banner media">
                                                        <div class="add-desc">
                                                            <h3>
                                                                Computer <br />
                                                                Services
                                                            </h3>
                                                            <div class="price-sale">2016</div>
                                                            <a href="#">Shop Now</a>
                                                        </div>
                                                        <div class="add-right">
                                                            <a href="#"><img
                                                                    src="{{ asset('frontend') }}/images/menu-banner-img2.jpg"
                                                                    alt="fashion" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="box-banner media">
                                                        <div class="add-desc">
                                                            <h3>Save up to</h3>
                                                            <div class="price-sale">
                                                                75 <sup>%</sup><sub>off</sub>
                                                            </div>
                                                            <a href="#">Shopping Now</a>
                                                        </div>
                                                        <div class="add-right">
                                                            <a href="#"><img
                                                                    src="{{ asset('frontend') }}/images/menu-banner-img3.jpg"
                                                                    alt=" html store" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach



                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-sm-11">
                <div class="mtmegamenu">
                    <ul class="hidden-xs">
                        @foreach ($categories as $parent)
                        <li class="mt-root">
                            <div class="mt-root-item">
                                <a href="{{ route('category',$parent->slug) }}">
                                    <div class="title title_font">
                                        <span class="title-text">{{ $parent->name }}<i
                                                class="fas fa-chevron-down"></i></span>
                                    </div>
                                </a>
                            </div>
                            <ul class="menu-items col-xs-12">
                                @foreach ($parent->allChildrens as $child)

                                <li class="menu-item depth-1 menucol-1-3">
                                    <div class="title title_font">
                                        <a href="{{ route('category',$child->slug) }}">{{ $child->name }}</a>
                                    </div>
                                    <ul class="submenu">
                                        @foreach ($child->allChildrens as $grand)
                                        <li class="menu-item">
                                            <div class="title">
                                                <a href="{{ route('category',$grand->slug) }}">{{ $grand->name }}</a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>