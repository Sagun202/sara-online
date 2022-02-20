<footer>
    <div class="footer-nav-links-space">
        <div class="container">
            <div class="row">
                @php($site = Theme::siteSetup())
                <div class="col-lg-3 footer-nav-links-left">
                    <div class="footer-nav-links-logo">
                        <img src="{{ asset('storage/'.$site->logo) }}" alt="{{ $site->name }}" />
                    </div>
                    <div class="footer-nav-links-text">
                        <p>
                            {!! $site->introduction !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 footer-nav-links-right">
                    <div class="col-md-6">
                        <div class="footer-nav-links-part">
                            <div class="footer-nav-links-part-heading">
                                {{ $site->name }}
                            </div>
                            <ul class="footer-nav-links-part-links">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('terms-of-use') }}">Terms of Use</a></li>
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('warranty') }}">Waranty Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-nav-links-part">
                            <div class="footer-nav-links-part-heading">
                                Earn with ClickMart
                            </div>
                            <ul class="footer-nav-links-part-links">
                                <li><a href="sell.html">Sell with Us</a></li>
                                <li><a href="{{ route('terms-of-sale') }}">Terms of Sale</a></li>
                            </ul>
                        </div>
                        <div class="footer-nav-links-part">
                            <div class="footer-nav-links-part-heading">
                                Customer Care
                            </div>
                            <ul class="footer-nav-links-part-links">
                                <li>
                                    <a href="consumer-rights.html">Consumer Rights</a>
                                </li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-nav-links-contact">
                        <p>Contacts Us</p>
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <p>{{ $site->address }}</p>
                            </li>
                            <li>
                                <i class="far fa-envelope"></i>
                                <p>{{ $site->email }}</p>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <p>{{ $site->phone }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-nav-links-socials">
                        <p>Follow us on</p>
                        <ul>
                            <li>
                                <a class="footer-nav-links-socials-facebook" href="{{ $site->facebook }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a class="footer-nav-links-socials-instagram" href="{{ $site->instagram }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a class="footer-nav-links-socials-twitter" href="{{ $site->twitter }}">
                                    <i class="fab fa-twitter-square"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="new_footer">
            @foreach (Theme::getFooterMenu() as $menu)

            <div class="new_footer-links">
                <div class="new_footer-link-heading">
                    <p>{{ $menu->title }}</p>
                </div>
                <ul class="new_footer-links-link">
                    @foreach ($menu->menus as $child)

                    <li><a href="{{ $child->link }}">{{ $child->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach

        </div>
    </div>

    <div class="footer-coppyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-xs-12 coppyright">
                    Copyright © {{ date('Y') }} <a href="#"> NAT </a>. All Rights Reserved.
                </div>
                <div class="col-sm-2 col-xs-12">
                    <div class="payment">
                        <ul>
                            <li>
                                <a href="#"><img title="Visa" alt="Visa"
                                        src="{{ asset('frontend') }}/images/visa.png" /></a>
                            </li>
                            <li>
                                <a href="#"><img title="Paypal" alt="Paypal"
                                        src="{{ asset('frontend') }}/images/paypal.png" /></a>
                            </li>
                            <li>
                                <a href="#"><img title="Discover" alt="Discover"
                                        src="{{ asset('frontend') }}/images/discover.png" /></a>
                            </li>
                            <li>
                                <a href="#"><img title="Master Card" alt="Master Card"
                                        src="{{ asset('frontend') }}/images/master-card.png" /></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-7 col-xs-12">
                    <ul class="footer-company-links">
                        <li><a href="#">Careers</a></li>
                        <li><a href="{{ route('warranty') }}">Waranty Policy</a></li>
                        <li><a href="#">Sell With Us</a></li>
                        <li><a href="{{ route('terms-of-use') }}">Terms of Use</a></li>
                        <li><a href="{{ route('terms-of-sale') }}">Terms of Sale</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="#">Consumer Rights</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-up"></i></a>