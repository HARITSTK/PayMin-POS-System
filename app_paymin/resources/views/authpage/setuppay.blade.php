<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="/assets/src/assets/logoMin.png" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>PayMin</title>
</head>

<body>
    <main class="flex items-center justify-between h-screen bg-[#E6EEFD] p-5 font-poppins font-light">
        <div class="w-full h-full absolute z-2 left-0 opacity-[15%]">
            <img src="/assets/src/assets/bgLoginPaymin-01.png" alt="Illustration" class="w-full h-auto" />
        </div>
        <section
            class="bg-white h-full w-full p-5 shadow-2xl rounded-lg overflow-hidden flex flex-col items-center justify-center">
            <div class="flex flex-1 flex-col items-center justify-center relative z-10 w-auto h-auto">
                <img src="/assets/src/assets/logo-01.png" alt="" width="200" class="mx-auto" />

                <p class="text-gray-600 mb-6 text-center">
                    easy to use and user friendly
                </p>
                <form id="newAccountForm" class="space-y-4 flex flex-col items-center" method="POST"
                    action="{{ route('SysSetup') }}">
                    @csrf
                    <!-- @method('PUT') -->
                    <div>
                        <label class="block text-gray-700">Username</label>
                        <input type="text" id="username" name="username"
                            class="w-[20em] p-2 border-2 border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F36A3D]" />
                        @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Name</label>
                        <input type="text" id="name" name="name"
                            class="w-[20em] p-2 border-2 border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F36A3D]" />
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-[20em] p-2 border-2 border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F36A3D]" />
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-[10em] mt-5 bg-[#F36A3D] text-white p-2 rounded-lg hover:bg-[#d55830] mx-auto">
                        Set Up
                    </button>
                </form>

            </div>
            <p class="text-center text-gray-400 mt-auto">
                © 2025 PayMin. All Rights Reserved.
            </p>
        </section>
        @if (Session::has('message'))
        <div id="auto-dismiss-alert"
            class="absolute top-1 right-1 transform translate-x-12 -translate-y-12 bg-primary text-white px-4 py-3 rounded shadow-md z-20 w-fit min-w-max"
            role="alert">
            <div class="flex items-center gap-x-2">
                <i class="fa fa-info-circle fa-2xs" aria-hidden="true"></i>
                <div class="flex-1">
                    <strong>{{ Session::get('message') }}</strong>
                </div>
                <button type="button" class="text-white hover:text-gray-300 ml-2"
                    onclick="this.closest('div[role=alert]').remove()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

        <script>
        setTimeout(() => {
            const alert = document.getElementById('auto-dismiss-alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
        </script>
        @endif
    </main>

    <script src="/src/js/script.js"></script>
</body>

</html>