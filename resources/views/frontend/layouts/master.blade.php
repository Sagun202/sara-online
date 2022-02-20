<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
    @livewireStyles
    <style>
        .mymultiplediv:hover .cart-mobile-view {
            display: block !important;
        }
    </style>
</head>

<body id="myDIV">
    @include('frontend.layouts.mobile-menu')
    <div id="page">
        @include('frontend.layouts.nav')
        <div class="">
            <div class="index-whitespace">
                @yield('content')
            </div>
        </div>
        @include('frontend.layouts.footer')
    </div>

    @include('frontend.layouts.script')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    <x-livewire-alert::scripts />
    
</body>

</html>