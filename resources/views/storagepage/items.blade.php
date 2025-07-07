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
    <!-- Alert Notification -->
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
                    <a href="{{ route('HomeStorage') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-home fa-2x"></i>

                        <p class="text-sm">Home</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('ItemStorage') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-th fa-2x"></i>
                        <p class="text-sm">Items</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('SettingStorage') }}" class="flex flex-col items-center justify-center">
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
                    <!-- Add Item Card -->
                    <div class="grid grid-cols-4 lg:grid-cols-4 auto-rows-auto gap-10 justify-items-center"
                        id="orderList">
                        <div id="addItemCard"
                            class="flex flex-col items-center justify-center border-2 border-dashed border-primary rounded-xl cursor-pointer hover:bg-[#FFB09F] transition-all duration-200 p-6 w-full h-[50vh]">
                            <button class="flex flex-col items-center justify-center focus:outline-none"
                                onclick="showModal('modalAddItem')">
                                <span class="flex items-center justify-center w-16 h-16 text-primary rounded-full mb-3">
                                    <span class="material-symbols-outlined" style="font-size: 5rem">add</span>
                                </span>
                                <span class="text-primary font-semibold">Add New Item</span>
                            </button>
                        </div>
                        <!-- Item Card Template (Repeated) -->
                        @foreach ($products as $p)
                        <div class="w-full h-full bg-white rounded-lg shadow-4xl card-container itemCard"
                            data-category="{{ strtolower($p->category->name) }}">
                            <div class="flex flex-col items-center w-full h-full">
                                <!-- Gambar produk -->
                                <img src="{{ $p->image ? asset('storage/' . $p->image) : asset('default.jpg') }}"
                                    alt="{{ $p->name }}"
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
                                        class="bg-linear-[180deg,_#FF5733,_#BB482F] h-full text-white text-lg w-full rounded-bl-lg"
                                        data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-desc="{{ $p->desc }}"
                                        data-price="{{ $p->price }}" data-stock="{{ $p->stock }}"
                                        data-category="{{ $p->category_id }}"
                                        data-subcategory="{{ $p->subcategory_id }}" data-image="{{ $p->image }}" onclick="showModalEdit(this)">
                                        Edit menu
                                    </button>
                                    <button
                                        class="text-gray-500 bg-tertiary hover:text-gray-700 w-[40%] h-full rounded-br-lg"
                                        data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->price }}"
                                        data-stock="{{ $p->stock }}" data-image="{{ $p->image }}"
                                        onclick="showModalDelete(this)">
                                        <div
                                            class="w-full h-full transition-all duration-200 flex items-center justify-center text-white text-lg">
                                            <span class="material-symbols-outlined"> delete </span>
                                        </div>
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
        <!-- Delete Items Modal -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md bg-opacity-50 flex justify-center items-center z-50 animate-fadeIn hidden"
            id="modalDeleteItem">
            <!-- Modal Container -->
            <form method="POST" action="{{ route('SysDeleteItem') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteItemId">
                <div class="bg-white rounded-2xl p-6 w-[300px] shadow-lg text-center modal-content">
                    <h2 class="text-lg font-semibold text-primary mb-4">Delete Items</h2>

                    <img id="deleteItemImage" src="/src/assets/coffee.png"
                        class="w-24 h-24 mx-auto mb-4 rounded-full object-cover" />

                    <h3 id="deleteItemName" class="text-lg font-semibold text-gray-800">produk</h3>
                    <p id="deleteItemInfo" class="text-sm text-gray-600">Harga | Stock</p>

                    <p class="text-xs text-gray-500 mt-4">
                        Deleting items will remove all of information<br />
                        from our database. This cannot be undone.
                    </p>

                    <div class="flex justify-between mt-6 space-x-4">
                        <button
                            class="flex-1 border border-primary text-primary rounded-xl py-2 hover:bg-red-100 transition"
                            onclick="closeModal('modalDeleteItem')" type="button">
                            Cancel
                        </button>
                        <button class="flex-1 bg-primary text-white rounded-xl py-2 hover:opacity-90 transition"
                            type="submit">
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Edit Item -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md bg-opacity-50 justify-center items-center z-50 animate-fadeIn hidden"
            id="modalEditItem">
            <form action="{{ route('SysEditItem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- @method('PUT') -->
                <!-- Modal Container -->
                <div
                    class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                    <!-- Modal Header -->
                    <div class="flex flex-col w-full">
                        <h2 class="text-xl font-semibold">Edit Item</h2>
                        <p>Edit this Item</p>
                    </div>

                    <!-- Modal Content -->
                    <div class="mt-4 flex justify-between gap-x-4 py-2">
                        <!-- drag and drop image -->
                        <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg w-[15vw] h-auto cursor-pointer hover:bg-gray-100 transition-all duration-200 p-3"
                            id="imageView">
                            <i class="fa fa-cloud-upload fa-3x text-gray-400"></i>
                            <p class="text-gray-500 mt-2 text-center">
                                Drag and drop your image here
                            </p>
                            <img id="editPreviewImage" class="mt-2 max-w-full max-h-60 hidden rounded" />
                            <input type="file" name="image" accept="image/*" id="editImageInput" class="hidden"
                                onchange="handleImageUpload(event, 'edit')" />
                            <button onclick="document.getElementById('editImageInput').click()" type="button"
                                class="mt-2 bg-primary text-white px-4 py-2 rounded cursor-pointer">Choose File</button>
                            <span id="editFileName" class="mt-1 text-sm text-gray-500"></span>
                        </div>

                        <!-- Input fields -->
                        <div class="mt-4">
                            <input type="hidden" name="id" id="edit_id">
                            <label for="itemName" class="block text-sm font-medium text-gray-700">Item Name</label>
                            <input type="text" id="edit_name" name="name"
                                class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                            <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Description
                                Items</label>
                            <input type="text" id="edit_desc" name="desc"
                                class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                            <div class="flex gap-x-4">
                                <div class="flex-1">
                                    <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Item
                                        Price</label>
                                    <input type="number" id="edit_price" name="price"
                                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                                </div>
                                <div class="flex-1">
                                    <label for="itemStockAdd" class="block text-sm font-medium text-gray-700 mt-4">Item
                                        Stock</label>
                                    <input type="number" id="edit_stock" name="stock"
                                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                                </div>
                            </div>
                            <div class="flex gap-x-4">
                                <div class="flex-1">
                                    <label for="itemCategory"
                                        class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                                    <select name="category_id" id="edit_category_id"
                                        class="itemCategory mt-1 p-1 block w-full cursor-pointer border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex-1">
                                    <label for="itemSubCategory"
                                        class="block text-sm font-medium text-gray-700 mt-4">Sub
                                        Category</label>
                                    <select name="subcategory_id" id="edit_subcategory_id"
                                        class="itemSubCategory mt-1 p-1 block w-full cursor-pointer border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                        @foreach ($subcategories as $group)
                                        @foreach ($group as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end gap-x-4">
                        <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                            onclick="closeModal('modalEditItem')" type="button">
                            Close
                        </button>
                        <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn" type="submit">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md bg-opacity-50 justify-center items-center z-50 animate-fadeIn hidden"
            id="modalAddItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Header -->
                <div class="flex flex-col w-full">
                    <h2 class="text-xl font-semibold">New Item</h2>
                    <p>Add New Item</p>
                </div>

                <!-- Modal Content -->
                <form action="{{ route('SysAddItem') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- @method('PUT') -->
                    <!-- Modal Content -->
                    <div class="mt-4 flex justify-between gap-x-4 py-2">
                        <!-- drag and drop image -->
                        <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg w-[15vw] h-auto cursor-pointer hover:bg-gray-100 transition-all duration-200 p-3"
                            id="imageView">
                            <i class="fa fa-cloud-upload fa-3x text-gray-400"></i>
                            <p class="text-gray-500 mt-2 text-center">
                                Drag and drop your image here
                            </p>
                            <img id="addPreviewImage" class="mt-2 max-w-full max-h-60 hidden rounded" />
                            <input type="file" name="image" accept="image/*" id="addImageInput" class="hidden"
                                onchange="handleImageUpload(event, 'add')" />
                            <button onclick="document.getElementById('addImageInput').click()" type="button"
                                class="mt-2 bg-primary text-white px-4 py-2 rounded cursor-pointer">Choose File</button>
                            <span id="addFileName" class="mt-1 text-sm text-gray-500"></span>
                        </div>

                        <!-- Input fields -->
                        <div class="mt-4">
                            <label for="itemName" class="block text-sm font-medium text-gray-700">Item Name</label>
                            <input type="text" id="itemName" name="name"
                                class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                            <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Description
                                Items</label>
                            <input type="text" id="itemDesc" name="desc"
                                class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                            <div class="flex gap-x-4">
                                <div class="flex-1">
                                    <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Item
                                        Price</label>
                                    <input type="number" id="itemPrice" name="price"
                                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                                </div>
                                <div class="flex-1">
                                    <label for="itemStockAdd" class="block text-sm font-medium text-gray-700 mt-4">Item
                                        Stock</label>
                                    <input type="number" id="itemStockAdd" name="stock"
                                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                                </div>
                            </div>

                            <div class="flex gap-x-4">
                                <div class="flex-1">
                                    <label for="itemCategory"
                                        class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                                    <select id="itemCategory" name="category_id"
                                        class="mt-1 p-1 block w-full cursor-pointer border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                        @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex-1">
                                    <label for="itemSubCategory"
                                        class="block text-sm font-medium text-gray-700 mt-4">Sub Category</label>
                                    <select id="itemSubCategory" name="subcategory_id"
                                        class="mt-1 p-1 block w-full cursor-pointer border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"></select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end gap-x-4">
                        <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                            onclick="closeModal('modalAddItem')" type="button">
                            Close
                        </button>
                        <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn" type="submit">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script>
    const subCategories = @json($subcategories);
    </script>
    <script src="assets/src/js/items.js"></script>
</body>

</html>