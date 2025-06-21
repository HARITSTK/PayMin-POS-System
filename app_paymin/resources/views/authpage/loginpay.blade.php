<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>PayMin</title>

</head>

<body>
    @if (Session::has('message'))
    <div id="auto-dismiss-alert"
        class="fixed top-4 right-4 bg-primary text-white px-4 py-3 rounded shadow-lg z-50 w-fit min-w-[250px] opacity-0 transition-opacity duration-300"
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
    const alert = document.getElementById('auto-dismiss-alert');
    if (alert) {
        // Muncul pelan
        setTimeout(() => {
            alert.classList.remove('opacity-0');
        }, 100);

        // Menghilang setelah 5 detik
        setTimeout(() => {
            alert.classList.add('opacity-0');
            setTimeout(() => alert.remove(), 300); // Setelah animasi selesai
        }, 5000);
    }
    </script>
    @endif

    <main class="flex items-center justify-between h-screen bg-[#E6EEFD] p-5 font-poppins font-light">
        <div class="w-full h-full absolute z-2 left-0 opacity-[15%]">
            <img src="assets/src/assets/bgLoginPaymin-01.png" alt="Illustration" class="w-full h-auto" />
        </div>
        <section
            class="bg-white h-full w-full p-5 shadow-2xl rounded-lg overflow-hidden flex flex-col items-center justify-center">
            <div class="flex flex-1 flex-col items-center justify-center relative z-10 w-auto h-auto">
                <img src="assets/src/assets/logo-01.png" alt="" width="200" class="mx-auto" />

                <p class="text-gray-600 mb-6 text-center">
                    easy to use and user friendly
                </p>
                <form id="loginForm" class="space-y-4 flex flex-col items-center" action="{{ route('SysLogin') }}"
                    method="POST">
                    @csrf
                    <!-- @method('PUT') -->
                    <div>
                        <label class="block text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-[20em] p-2 border-2 border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F36A3D]" />
                        @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative w-[20em]">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 pr-10 border-2 border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F36A3D]" />

                        <!-- Eye Icon -->
                        <span onclick="togglePassword()"
                            class="absolute top-[38px] right-3 cursor-pointer text-gray-600">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>

                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-[10em] mt-5 bg-[#F36A3D] text-white p-2 rounded-lg hover:bg-[#d55830] mx-auto">
                        Login
                    </button>
                </form>
            </div>
            <p class="text-center text-gray-400 mt-auto">
                © 2025 PayMin. All Rights Reserved.
            </p>
        </section>
    </main>


    <script src="/src/js/script.js"></script>
    <script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.959 9.959 0 012.208-3.419m1.435-1.407A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.012 4.614M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
    </script>

</body>

</html>