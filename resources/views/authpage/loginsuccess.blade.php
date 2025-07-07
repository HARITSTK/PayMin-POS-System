<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Hapus Tailwind CLI dan pakai Laravel Vite --}}
    {{-- <link href="./src/output.css" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="/assets/src/assets/logoMin.png" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PayMin</title>
    <style>
    @keyframes surface-emerge {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .flex-col {
        animation: surface-emerge 0.8s ease-out forwards;
    }

    .mt-auto {
        animation: surface-emerge 0.8s ease-out 0.2s forwards;
        opacity: 0;
        /* Start invisible */
    }

    /* Optional: Add a subtle scale effect */
    img {
        animation: surface-emerge 0.8s ease-out, scale-in 0.8s ease-out;
    }

    @keyframes scale-in {
        0% {
            transform: scale(0.95);
        }

        100% {
            transform: scale(1);
        }
    }
    </style>
</head>

<body>

    <main class="flex items-center justify-between h-screen bg-[#E6EEFD] p-5 font-poppins font-light">
        <div class="w-full h-full absolute z-2 left-0 opacity-[15%]">
            <img src="assets/src/assets/bgLoginPaymin-01.png" alt="Illustration" class="w-full h-auto" />
        </div>
        <section
            class="bg-white h-full w-full p-5 shadow-2xl rounded-lg overflow-hidden flex flex-col items-center justify-center hidden"
            id="loginSuccess">
            <div class="flex flex-1 flex-col items-center justify-center relative z-20">
                <p class="mt-4 tracking-wide text-primary font-bold text-[60pt] animate-jump-in animate-once">
                    <span class="text-textColor">Login</span> Successful
                </p>
            </div>

            <p class="mt-auto mb-2 text-textColor">
                © 2025 PayMin. All Rights Reserved.
            </p>
        </section>
        <section
            class="bg-white h-full w-full p-5 shadow-2xl rounded-lg overflow-hidden flex flex-col items-center justify-center hidden"
            id="welcomeUser">
            <div class="flex flex-1 flex-col items-center justify-center relative z-10">
                <p class="mt-4 text-primary font-bold text-[60pt]">
                    <span class="text-textColor animate-fade-right animate-once">Welcome</span>
                    <span class="animate-fade-left animate-once">User</span>
                </p>
            </div>

            <p class="mt-auto mb-2 text-textColor">
                © 2025 PayMin. All Rights Reserved.
            </p>
        </section>
    </main>
    <script>
    const loginSection = document.getElementById('loginSuccess');
    const welcomeSection = document.getElementById('welcomeUser');

    setTimeout(() => {
        loginSection.classList.remove('hidden');
        welcomeSection.classList.add('hidden');
    }, 6000);
    
    setTimeout(() => {
        loginSection.classList.add('hidden');
        welcomeSection.classList.remove('hidden');
    }, 3000);

    setTimeout(() => {
        window.location.href = "{{ $redirectTo ?? route('Home') }}";
    }, 9000);
    </script>
</body>

</html>