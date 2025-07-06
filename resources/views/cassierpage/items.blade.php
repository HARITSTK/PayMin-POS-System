<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/items.css" />
    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon" />
    <title>PayMin</title>

    <!-- Google Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <main class="flex items-center justify-between h-screen bg-[#E6EEFD] overflow-hidden font-poppins">
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
                    <a href="{{ route('HomeCassier') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-home fa-2x"></i>

                        <p class="text-sm">Home</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('OrderCassier') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-cart-plus fa-2x"></i>
                        <p class="text-sm">Orders</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('ReportCassier') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-file-text-o fa-2x"></i>
                        <p class="text-sm">Report</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('ItemCassier') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-th fa-2x"></i>
                        <p class="text-sm">Items</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('MemberCassier') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-diamond fa-2x" aria-hidden="true"></i>
                        <p class="text-sm">Member</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('SettingCassier') }}" class="flex flex-col items-center justify-center">
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
            <div class="">
                <h1 class="text-[36pt] font-bold text-[#353535]">Items Management</h1>
            </div>
            <div class="flex gap-4 py-6 w-full">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500">Out of Stock</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $outOfStock }} Items</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500">Low Stock</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $lowStock }} Items</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xs text-gray-500">Total Items</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }} Items</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 shadow-4xl h-[40em] w-full relative rounded-lg">
                <!-- Items Sorting -->
                <div class="flex justify-between w-full h-auto border-gray-600 bg-white border-b-[1px] p-2">
                    <ul class="flex flex-row items-center gap-3">
                        <li data-filter="all"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                All
                            </button>
                        </li>
                        <li data-filter="food"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                Food
                            </button>
                        </li>
                        <li data-filter="drink"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                Drink
                            </button>
                        </li>
                        <li data-filter="snack"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                Snack
                            </button>
                        </li>
                        <li data-filter="dessert"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                Dessert
                            </button>
                        </li>
                        <li data-filter="signature"
                            class="filter-btn border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                            <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                                Signature
                            </button>
                        </li>
                    </ul>

                    <form class="flex items-center gap-2">
                        <div class="relative w-full">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" placeholder="Find Items" id="searchInput" onkeyup="searchTable()"
                                value="{{ old('search') }}"
                                class="border border-gray-300 rounded-2xl pl-10 pr-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>
                    </form>
                </div>

                <!-- Items List -->
                <div class="w-full h-[33em] overflow-y-auto p-4">
                    <div class="grid grid-cols-4 lg:grid-cols-4 auto-rows-auto gap-10 justify-items-center"
                        id="orderList">
                        @foreach ($products as $p)
                        <div class="itemCard w-full h-full bg-white rounded-lg shadow-4xl card-container"
                            data-category="{{ strtolower($p->category->name) }}">
                            <div class="itemCard flex flex-col items-center w-full h-full">
                                <!-- Gambar produk -->
                                <img src="{{ asset('upload/product/'. $p->image) }}" alt="{{ $p->name }}"
                                    class="w-44 object-cover rounded-full border-4 border-white shadow" />

                                <div class="flex flex-col items-center justify-center w-full mt-auto">
                                    <!-- Nama produk -->
                                    <h2 class="item-name font-semibold text-center text-gray-800 text-lg">
                                        {{ $p->name }}
                                    </h2>

                                    <!-- Harga dan stok -->
                                    <p class="text-[11pt] text-gray-500 mt-1 mb-2.5">
                                        {{ $p->desc }}
                                    </p>

                                    <!-- Harga dan stok -->
                                    <p class="text-[11pt] text-gray-500 mt-1 mb-2.5">
                                        Rp. {{ $p->price }} <span class="mx-1">|</span> {{ $p->stock }} Stock
                                    </p>
                                </div>

                                <!-- Tombol -->
                                <div class="w-full flex justify-between items-center mt-auto h-16">
                                    <button
                                        class="bg-linear-[180deg,_#FF5733,_#BB482F] h-[80%] text-white text-lg w-full mt-auto rounded-b-lg"
                                        onclick="showProductDetailCassier(this)" data-id="{{ $p->id }}"
                                        data-name="{{ $p->name }}" data-stock="{{ $p->stock }}"
                                        data-price="{{ $p->price }}" data-desc="{{ $p->desc }}"
                                        data-image="{{ asset('uploads/products/' . $p->image) }}">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Search icon -->
                        <div id="noResultsMessage"
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center hidden">
                            <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                            <p class="my-12 text-lg">
                                We can’t find any item matching your search
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Detail Item -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md bg-opacity-50 justify-center items-center z-50 animate-fadeIn hidden"
            id="modalDetailItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-[45%] h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Header -->
                <div class="flex flex-col w-full">
                    <h2 class="text-xl font-semibold">Detail Item</h2>
                    <p>Info about item</p>
                </div>

                <!-- Modal Content -->
                <div class="mt-4 flex justify-between gap-x-4 py-2">
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg w-[15vw] h-auto cursor-pointer hover:bg-gray-100 transition-all duration-200 p-3"
                        id="imageView">
                        <img src="assets/src/assets/coffee.png" alt="Product Image" id="modalItemImage"
                            class="w-full h-auto object-cover rounded-lg mb-2" />
                    </div>

                    <!-- Detail Produk -->
                    <div class="flex flex-col w-[55%] justify-between text-gray-800 text-sm">
                        <div class="space-y-4">
                            <div class="flex justify-between border-b pb-1">
                                <span>Items Name</span>
                                <span class="font-medium" id="modalItemName">Cappucinoi</span>
                            </div>
                            <div class="flex justify-between border-b pb-1">
                                <span>Items Stock</span>
                                <span class="font-medium" id="modalItemStock">234</span>
                            </div>
                            <div class="flex justify-between border-b pb-1">
                                <span>Items Price</span>
                                <span class="font-medium" id="modalItemPrice">20.000</span>
                            </div>
                            <div class="border-b pb-1">
                                <span class="block mb-1">Detail Product</span>
                                <p class="text-right font-medium leading-tight" id="modalItemDesc">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-end gap-x-4">
                    <button
                        class="border-2 border-primary text-primary px-4 py-2 rounded hover:bg-primary hover:text-white"
                        onclick="closeModal('modalDetailItem')">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/src/js/items.js"></script>
</body>

</html>