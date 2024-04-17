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
        <div id="coverDiv" class="bg-dark-subtle d-none w-100 h-100 position-absolute z-3 start-0 top-0">
            <button id="install">Install</button>
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


    <script type="module">

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
            installButton.setAttribute("hidden", "");
        }


        window.addEventListener("appinstalled", () => {
            disableInAppInstallPrompt();
        });

        function disableInAppInstallPrompt() {
            installPrompt = null;
            installButton.setAttribute("hidden", "");
        }
    </script>

    <script>
        function isRunningStandalone() {
            return (window.matchMedia('(display-mode: standalone)').matches);
        }

        if (isRunningStandalone()) {
            //     alert('da')
            /* This code will be executed if app is running standalone */
        } else {
            //     alert('norun')
        }
    </script>
</body>

</html>
