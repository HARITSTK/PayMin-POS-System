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

<body onclick="window.location.href='{{ route('Auth') }}'" class="cursor-pointer">

    <main class="flex items-center justify-between h-screen bg-[#E6EEFD] p-5 font-poppins font-light">
        <section
            class="bg-white h-full w-full p-5 shadow-2xl rounded-lg overflow-hidden flex flex-col items-center justify-center">
            <div class="flex flex-1 flex-col items-center justify-center">
                <img src="/assets/src/assets/logo-01.png" alt="logo" width="300" />
                <p class="mt-4 tracking-wide text-textColor">
                    Click Any Where to Login
                </p>
            </div>

            <p class="mt-auto mb-2 text-textColor">
                © 2025 PayMin. All Rights Reserved.
            </p>
        </section>
    </main>

</body>

</html>