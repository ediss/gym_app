<!doctype html>
<html lang="en" data-bs-theme="dark">
@include('web.layouts.head')

<body>

    {{-- <!--start header--> --}}
    @include('web.layouts.header')
    <!--end header-->

    <!--start sidebar-->
    @include('web.layouts.sidebar')
    <!--end sidebar-->

    @yield('additionalHeader')

    <!--start main content-->
    <main class="page-content">
        @yield('content')
    </main>
    <!--end main content-->

    <!--start theme customization-->

    <!--end theme customization-->


    <!--plugins-->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/index.js') }}"></script>
    <script src="{{ asset('frontend/js/dateFormat.js') }}"></script>

    <!--BS Scripts-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    @yield('scripts')

    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            console.log("Will the service worker register?");
            navigator.serviceWorker.register('../../../../public/frontend/js/service-worker.js')
                .then(function(reg) {
                    console.log("Yes, it did.");
                }).catch(function(err) {
                    console.log("No it didn't. This happened:", err)
                });
        }
    </script>
</body>

</html>
