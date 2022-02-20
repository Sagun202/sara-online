<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
    @livewireStyles
</head>

<body class="cms-index-index cms-home-page">
    @include('frontend.layouts.mobile-menu')
    <div id="page">
        @include('frontend.layouts.nav')
        <div class="container-fluid">
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