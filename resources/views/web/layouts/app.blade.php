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

    <script>
        // Initialize deferredPrompt for use later to show browser install prompt.
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            // Update UI notify the user they can install the PWA
            showInstallPromotion();
            // Optionally, send analytics event that PWA install promo was shown.
            console.log(`'beforeinstallprompt' event was fired.`);
        });

        buttonInstall.addEventListener('click', async () => {
            // Hide the app provided install promotion
            hideInstallPromotion();
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            const {
                outcome
            } = await deferredPrompt.userChoice;
            // Optionally, send analytics event with outcome of user choice
            console.log(`User response to the install prompt: ${outcome}`);
            // We've used the prompt, and can't use it again, throw it away
            deferredPrompt = null;
        });


        window.addEventListener('appinstalled', () => {
            // Hide the app-provided install promotion
            hideInstallPromotion();
            // Clear the deferredPrompt so it can be garbage collected
            deferredPrompt = null;
            // Optionally, send analytics event to indicate successful install
            console.log('PWA was installed');
        });


        function getPWADisplayMode() {
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches;
            if (document.referrer.startsWith('android-app://')) {
                return 'twa';
            } else if (navigator.standalone || isStandalone) {
                return 'standalone';
            }
            return 'browser';
        }
    </script>
</body>

</html>
