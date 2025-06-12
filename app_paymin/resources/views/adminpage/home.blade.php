<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/home.css" />
    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon" />
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
        <!-- Navigation Bar -->
        <nav id="navbar" class="bg-white h-full overflow-hidden w-[7.2rem] min-w-[7.2rem] p-5 shadow-4xl rounded-r-4xl">
            <ul id="navbar-list" class="flex flex-col h-full w-full relative z-10">
                <!-- Daftar item navigasi utama -->
                <li>
                    <div class="flex items-center justify-center mb-2">
                        <img src="assets/src/assets/logoMin.png" alt="Logo" class="w-20 h-20 rounded-full" />
                    </div>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Home') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-home fa-2x"></i>

                        <p class="text-sm">Home</p>
                    </a>
                </li>

                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Report') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-file-text-o fa-2x"></i>
                        <p class="text-sm">Report</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Item') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-th fa-2x"></i>
                        <p class="text-sm">Items</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Member') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-diamond fa-2x" aria-hidden="true"></i>
                        <p class="text-sm">Member</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Master') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-key fa-2x" aria-hidden="true"></i>
                        <p class="text-sm">Master</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Setting') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-cog fa-2x"></i>
                        <p class="text-sm">Settings</p>
                    </a>
                </li>
                <span class="highlight-span mx-auto shadow-2xl"></span>
                <li class="flex flex-col items-center justify-center mt-auto text-[#8B8B8B] hover:text-red-400 cursor-pointer"
                    onclick="showModal('modalLogout')">
                    <a class="flex flex-col items-center justify-center">
                        <i class="fa fa-sign-out fa-2x"></i>
                        <p class="text-sm">Logout</p>
                    </a>
                </li>
            </ul>

            <!-- Logout Modal -->
            <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
                id="modalLogout">
                <!-- Modal Container -->
                <div
                    class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">

                    <!-- Modal Content -->
                    <div class="mt-4 flex flex-col gap-y-2 py-2">
                        <h1 class="text-3xl font-bold text-red-500 mb-2">Logout</h1>
                        <p class="text-lg text-gray-800">
                            Are you sure for logout and destroy all session?.
                        </p>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end gap-x-4">
                        <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                            onclick="closeModal('modalLogout')">
                            Close
                        </button>
                        <a class="bg-primary text-white px-4 py-2 rounded" href="{{ route('Logout') }}">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

        </nav>
        <!-- Main Content -->
        <section class="h-full w-full p-11 box-border overflow-y-auto">
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-[36pt] font-bold text-[#353535]">
                    <span class="font-medium">Welcome</span> {{ $user->name }} !
                </h1>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-4 grid-rows-[0.5fr_1fr_0.5fr_1fr_0.2fr] gap-6">
                <!-- Total Income -->
                <div
                    class="bg-gradient-to-b from-white from-70% to-gray-400 to-100% p-3 flex flex-col rounded-xl shadow-4xl border-2 border-[#E4E4E4] hover:border-primary transition-all duration-300 ease-in-out">
                    <h1 class="text-gray-400 mb-5 text-[15pt]">Total Income</h1>
                    <div class="flex w-full justify-between items-center mt-auto">
                        <div class="flex flex-col justify-between mb-2">
                            <p class="font-bold text-md text-textColor">Rp. 1.000.000</p>
                            <p class="text-gray-400 font-medium">Last Month</p>
                        </div>
                        <div
                            class="text-sm text-[#067647] bg-[#E6EEFD] h-[30%] rounded-2xl flex items-center justify-center gap-2 p-3">
                            <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                            2,5%
                        </div>
                    </div>
                </div>
                <!-- Total Items -->
                <div
                    class="bg-white p-3 flex flex-col rounded-xl shadow-4xl bg-gradient-to-b from-white from-70% to-gray-400 to-100% border-2 border-[#E4E4E4] hover:border-primary transition-all duration-300 ease-in-out">
                    <h1 class="text-gray-400 mb-5 text-[15pt]">Total Items</h1>
                    <div class="flex w-full justify-between items-center mt-auto">
                        <div class="flex flex-col justify-between mb-2">
                            <p class="font-bold text-md text-textColor">Rp. 1.000.000</p>
                            <p class="text-gray-400 font-medium">Last Month</p>
                        </div>
                        <div
                            class="text-sm text-[#F4221F] bg-[#FFE5D7] h-[30%] rounded-2xl flex items-center justify-center gap-2 p-3">
                            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                            2,5%
                        </div>
                    </div>
                </div>
                <!-- Total Costumers -->
                <div
                    class="bg-white p-3 flex flex-col rounded-xl shadow-4xl bg-gradient-to-b from-white from-70% to-gray-400 to-100% border-2 border-[#E4E4E4] hover:border-primary transition-all duration-300 ease-in-out">
                    <h1 class="text-gray-400 mb-5 text-[15pt]">Total Costumers</h1>
                    <div class="flex w-full justify-between items-center mt-auto">
                        <div class="flex flex-col justify-between mb-2">
                            <p class="font-bold text-md text-textColor">Rp. 1.000.000</p>
                            <p class="text-gray-400 font-medium">Last Month</p>
                        </div>
                        <div
                            class="text-sm text-[#067647] bg-[#E6EEFD] h-[30%] rounded-2xl flex items-center justify-center gap-2 p-3">
                            <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                            2,5%
                        </div>
                    </div>
                </div>
                <!-- Low Stocks -->
                <div
                    class="row-span-3 bg-linear-[180deg,_#FF5733,_#BB482F] p-4 flex flex-col rounded-xl shadow-4xl border-2 border-white box-content">
                    <h1 class="text-white mb-5 mt-2 text-2xl font-medium">Low Stock</h1>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2">
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
                            <span class="text-gray-500 text-[10pt] w-20 text-center mb-2">Coffe Capucino</span>
                            <span class="font-bold text-l text-[#353535]">Stock 5</span>
                            <div
                                class="text-sm text-[#F4221F] bg-[#FFE5D7] h-auto rounded-2xl gap-1 py-1 px-4 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
                            <span class="text-gray-500 text-[10pt] w-20 text-center mb-2">Coffe Capucino</span>
                            <span class="font-bold text-l text-[#353535]">Stock 5</span>
                            <div
                                class="text-sm text-[#F4221F] bg-[#FFE5D7] h-auto rounded-2xl gap-1 py-1 px-4 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
                            <span class="text-gray-500 text-[10pt] w-20 text-center mb-2">Coffe Capucino</span>
                            <span class="font-bold text-l text-[#353535]">Stock 5</span>
                            <div
                                class="text-sm text-[#F4221F] bg-[#FFE5D7] h-auto rounded-2xl gap-1 py-1 px-4 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                        <div
                            class="bg-white px-2 py-6 rounded-lg shadow-4xl flex flex-col items-center mb-3 relative w-full h-full">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-16 mb-2" />
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
                <!-- Product List -->
                <div
                    class="col-span-2 row-span-4 bg-linear-[180deg,_#FF5733,_#BB482F] p-4 flex flex-col rounded-xl shadow-4xl border-2 border-white box-content">
                    <div class="flex items-center justify-between mb-1 w-auto p-4">
                        <h1 class="font-medium text-white text-2xl">Product List</h1>
                        <div class="flex items-center justify-between gap-4">
                            <span
                                class="material-symbols-outlined text-[#FB8E77] bg-[#E6EEFD] rounded-lg p-2 flex items-center justify-center shadow-4xl cursor-pointer">
                                chevron_left
                            </span>

                            <span
                                class="material-symbols-outlined text-[#FB8E77] bg-[#E6EEFD] rounded-lg p-2 shadow-4xl cursor-pointer">
                                chevron_right
                            </span>
                        </div>
                    </div>

                    <div class="h-full w-full rounded-xl">
                        <div class="grid grid-cols-3 grid-rows-2 gap-2 p-2 h-full">
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center bg-white rounded-lg shadow-4xl w-auto h-full p-3">
                                <div class="flex mx-auto w-[8rem]">
                                    <img src="assets/src/assets/coffee.png" alt="Coffee" class="object-cover w-full" />
                                </div>
                                <div class="flex flex-col items-center w-full my-auto">
                                    <span class="text-gray-500 text-[15pt] mb-1 font-medium">Coffe Latte</span>
                                    <span class="font-bold text-[13pt] text-[#353535]">Price Rp. 12.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sales Growth -->
                <div
                    class="row-span-2 col-start-3 bg-linear-[180deg,_#FF5733,_#BB482F] p-6 flex flex-col rounded-xl shadow-4xl border-2 border-white box-content">
                    <div class="flex items-center justify-between mb-5 w-auto">
                        <h1 class="font-medium text-white text-2xl">Sales Growth</h1>
                    </div>

                    <div class="flex flex-col justify-between gap-3">
                        <div
                            class="bg-white p-2 w-full rounded-lg flex items-center shadow-4xl relative border-2 border-[#E4E4E4]">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-12" />
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-sm">Coffe Capucino</span>
                                <span class="font-bold text-[#353535]">251+</span>
                            </div>
                            <div
                                class="text-sm text-[#067647] bg-[#E6EEFD] h-auto rounded-2xl flex items-center justify-center gap-1 px-4 py-1 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                        <div
                            class="bg-white p-2 w-full rounded-lg shadow-4xl flex items-center relative border-2 border-[#E4E4E4]">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-12" />
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-sm">Coffe Capucino</span>
                                <span class="font-bold text-[#353535]">251+</span>
                            </div>
                            <div
                                class="text-sm text-[#067647] bg-[#E6EEFD] h-auto rounded-2xl flex items-center justify-center gap-1 px-4 py-1 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                        <div
                            class="bg-white p-2 w-full rounded-lg shadow-4xl flex items-center relative border-2 border-[#E4E4E4]">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-12" />
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-sm">Coffe Capucino</span>
                                <span class="font-bold text-[#353535]">251+</span>
                            </div>
                            <div
                                class="text-sm text-[#067647] bg-[#E6EEFD] h-auto rounded-2xl flex items-center justify-center gap-1 px-4 py-1 absolute -right-4 -top-2">
                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                2,5%
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Orders Today -->
                <div
                    class="col-span-2 row-span-2 col-start-3 row-start-4 bg-gradient-to-b from-white from-40% to-gray-300 to-100% border-2 border-white p-3 flex flex-col rounded-xl shadow-4xl">
                    <div class="flex items-center justify-between mb-2 w-auto px-3 cursor-pointer">
                        <h1 class="font-bold text-textColor text-2xl">Orders Today</h1>
                        <div class="flex items-center justify-between gap-2">
                            <h2>View All</h2>
                            <span class="material-symbols-outlined"> arrow_forward </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 my-auto gap-2">
                        <div
                            class="bg-white p-1 w-full rounded-lg shadow-xl flex items-center border-gray-200 border-2 box-border">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-18 h-18" />
                            <div class="flex flex-col mr-10">
                                <span class="text-gray-500 text-base">Coffe Capucino</span>
                                <span class="font-bold text-[#353535] text-lg">251 Orders</span>
                            </div>
                        </div>
                        <div
                            class="bg-white p-1 w-full rounded-lg shadow-xl flex items-center border-gray-200 border-2 box-border">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-18 h-18" />
                            <div class="flex flex-col mr-10">
                                <span class="text-gray-500 text-base">Coffe Capucino</span>
                                <span class="font-bold text-[#353535] text-lg">251 Orders</span>
                            </div>
                        </div>
                        <div
                            class="bg-white p-1 w-full rounded-lg shadow-xl flex items-center border-gray-200 border-2 box-border">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-18 h-18" />
                            <div class="flex flex-col mr-10">
                                <span class="text-gray-500 text-base">Coffe Capucino</span>
                                <span class="font-bold text-[#353535] text-lg">251 Orders</span>
                            </div>
                        </div>
                        <div
                            class="bg-white p-1 w-full rounded-lg shadow-xl flex items-center border-gray-200 border-2 box-border">
                            <img src="assets/src/assets/coffee.png" alt="Coffee" class="w-18 h-18" />
                            <div class="flex flex-col mr-10">
                                <span class="text-gray-500 text-base">Coffe Capucino</span>
                                <span class="font-bold text-[#353535] text-lg">251 Orders</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/src/js/home.js"></script>
</body>

</html>