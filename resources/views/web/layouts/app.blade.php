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
        {{--  --}}
        <div id="coverDiv"
            class="d-none bg-dark-subtle w-100 h-100 position-absolute z-2 start-0 top-0 end-0 d-flex align-items-center justify-content-center">
            <div class="row text-center">
                <div class="col-8 offset-2 col-md-12 offset-md-0 mt-3 mb-5">
                    <img src="{{ asset('frontend/images/logo.png') }}" class="img-fluid">
                </div>
                <div class="col-12 w-100 mt-5">
                    <button id="install" class="btn btn-warning text-white">Install FitPal as Mobile App</button>
                </div>

            </div>

        </div>


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


    <script>
        let installPrompt = null;
        const installButton = document.querySelector("#install");
        const coverDiv = document.querySelector("#coverDiv");

        window.addEventListener("beforeinstallprompt", (event) => {
            event.preventDefault();
            installPrompt = event;
            coverDiv.classList.remove("d-none");
        });


        installButton.addEventListener("click", async () => {
            if (!installPrompt) {
                return;
            }
            const result = await installPrompt.prompt();
            console.log(`Install prompt was: ${result.outcome}`);
            disableInAppInstallPrompt();
        });


        function disableInAppInstallPrompt() {
            installPrompt = null;
            coverDiv.classList.add("d-none");
        }


        window.addEventListener("appinstalled", () => {
            disableInAppInstallPrompt();
        });
    </script>


    <script>
        // Detects if device is on iOS 
        const isIos = () => {
            const userAgent = window.navigator.userAgent.toLowerCase();
            return /iphone|ipad|ipod/.test(userAgent);
        }
        // Detects if device is in standalone mode
        const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

        // Checks if should display install popup notification:
        if (isIos() && !isInStandaloneMode()) {
            this.setState({
                showInstallMessage: true
            });
        }
    </script>
</body>

</html>
