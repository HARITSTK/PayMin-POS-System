<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/FEproject/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/FEproject/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/FEproject/src/components/home.css" />
    <link rel="shortcut icon" href="/assets/logoMin.png" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>PayMin</title>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Google Icons -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Style -->
    <style></style>
</head>

<body>
    <main class="flex items-center justify-between h-screen font-poppins box-border bg-[#E6EEFD]">
        <nav id="navbar" class="bg-white h-full overflow-hidden w-[7.2rem] min-w-[7.2rem] p-5 shadow-4xl rounded-r-4xl">
            <div class="flex items-center justify-center mb-2">
                <img src="/assets/logoMin.png" alt="Logo" class="w-20 h-w-20 rounded-full" />
            </div>
            <ul id="navbar-list" class="flex flex-col h-full w-full relative z-10">
                <!-- Daftar item navigasi utama -->

                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-home fa-2x"></i>
                        <p class="text-sm">Home</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Order') }}" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-cart-plus fa-2x"></i>
                        <p class="text-sm">Orders</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Report') }}" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-file-text-o fa-2x"></i>
                        <p class="text-sm">Report</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-th fa-2x"></i>
                        <p class="text-sm">Items</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer active">
                    <a href="{{ route('Master') }}" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-key fa-2x"></i>
                        <p class="text-sm">Master</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-white transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Setting') }}" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-cog fa-2x"></i>
                        <p class="text-sm">Settings</p>
                    </a>
                </li>
                <span class="highlight-span mx-auto shadow-2xl"></span>
                <li
                class="flex flex-col items-center justify-center mt-[4em] text-[#8B8B8B] hover:text-red-400 cursor-pointer">
                    <a href="{{ route('logout') }}" class="flex flex-col items-center justify-center" onclick="route()">
                        <i class="fa fa-sign-out fa-2x"></i>
                        <p class="text-sm">Logout</p>                
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <section class="h-full w-full p-11 box-border overflow-y-auto">
            <div class="mb-8">
            <h1 class="text-[36pt] font-bold text-[#353535]">
                Setting
            </h1>
            </div>

            <!-- Low Stocks -->
                <div
                    class="row-span-3 bg-linear-[180deg,_#FF5733,_#BB482F] p-4 flex flex-col rounded-xl shadow-4xl border-2 border-white box-content">
                    <h1 class="text-white mb-5 mt-2 text-2xl font-medium">Low Stock</h1>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2">
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
                            <span class="text-gray-500 text-[10pt] w-20 text-center mb-2">Coffe Capucino</span>
                            <span class="font-bold text-l text-[#353535]">Stock 5</span>
                        </div>
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
                            <span class="text-gray-500 text-[10pt] w-20 text-center mb-2">Coffe Capucino</span>
                            <span class="font-bold text-l text-[#353535]">Stock 5</span>
                            <div
                                class="text-sm text-[#F4221F] bg-[#FFE5D7] h-auto rounded-2xl gap-1 py-1 px-4 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                    </div>
                </div>
            
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/src/js/script.js"></script>
</body>

</html>