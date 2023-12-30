<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>

    {{-- Loader --}}
    <x-loader></x-loader>


    <!--    Notification or Popup handle-->
    @if (session()->has('error'))
        <div id="notify" class="fixed bottom-10 right-10 bg-red-600 rounded-xl">
            <div class="font-bold text-white py-4 px-4 rounded-t flex items-center">
                <div class="bg-white p-2 rounded-full">
                    <i class="text-red-600 mx-1 bi bi-info-circle-fill"></i>
                </div>
                <div class="ms-2">
                    {{ session('error') }}
                </div>
            </div>
            <div id="loader" class="bg-white h-1" style="width: 100%"></div>
        </div>
    @endif
    <script>

        /**
         * Handle the notification popup when appear
         */
        function handleNotification() {
            const notif = document.getElementById('notify'),
                TIME_TO_REMOVE_NODE = 10000,
                A_SECOND = 1000,
                TIME_IN_SECOND = (TIME_TO_REMOVE_NODE / A_SECOND);

            if (notif) {
                const loader = notif.querySelector('#loader');

                // remove node when clicked
                notif.addEventListener('click', () => {
                    notif.style.transition = `all 5s`
                    notif.remove()
                })

                // remove if they was appear for a second
                setTimeout(() => notif.remove(), TIME_TO_REMOVE_NODE);

                // add animation into the loader
                loader.style.transition = `all ${TIME_IN_SECOND}s`
                loader.style.width = '0%'

            }
        }

        window.onload = async function() {
            handleNotification()
        }
    </script>

    @yield('content')
    <div>
        @include('includes.footer')
    </div>
</body>

</html>
