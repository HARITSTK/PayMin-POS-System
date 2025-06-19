<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/report.css" />
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
        <!-- Navbar -->
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
            <div class="mb-8">
                <h1 class="text-[36pt] font-bold text-[#353535]">Orders History</h1>
            </div>

            <div class="flex gap-x-4 items-center">
                <div class="relative inline-block w-48 h-full">
                    <select
                        class="appearance-none w-full bg-white border border-gray-300 text-textColor py-2 px-4 pr-10 rounded-xl leading-tight focus:outline-none focus:border-primary">
                        <option>All</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>

                    <!-- Dropdown Arrow Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                        <span class="material-symbols-outlined"> arrow_drop_down </span>
                    </div>
                </div>

                <a id="sortingDropdown" href="{{ route('exportCSVReport') }}"
                    class="flex justify-between items-center w-auto px-2 py-1 bg-white rounded-xl shadow-sm text-left text-lg text-gray-800 gap-x-4">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span>CSV</span>
                </a>
            </div>

            <div class="flex gap-4 py-6 w-full">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Total Income</p>
                        <p class="text-3xl font-bold text-gray-800">Rp. 200.000</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Total Items sell</p>
                        <p class="text-3xl font-bold text-gray-800">+Rp. 200.000</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Total Costumers</p>
                        <p class="text-3xl font-bold text-gray-800">-Rp. 200.000</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 items-center">
                <div class="relative inline-block w-48 flex-1">
                    <select id="userFilter" onchange="filterByUser()"
                        class="appearance-none w-full bg-white border border-gray-300 text-gray-900 text-base px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option>All</option>
                        @foreach ($user as $s)
                        <option>{{ $s->name }}</option>
                        @endforeach
                    </select>

                    <!-- Dropdown Arrow Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                        <span class="material-symbols-outlined"> arrow_drop_down </span>
                    </div>
                </div>

                <div class="relative inline-block w-48">
                    <select
                        class="appearance-none w-full bg-white border border-gray-300 text-textColor py-2 px-4 pr-10 rounded-xl leading-tight focus:outline-none focus:border-primary">
                        <option>Pilih shift</option>
                        <option>
                            Pagi <br />
                            09:00-16:00
                        </option>
                        <option>Malam 16:00-22:00</option>
                    </select>

                    <!-- Dropdown Arrow Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                        <span class="material-symbols-outlined"> arrow_drop_down </span>
                    </div>
                </div>

                <!-- Find order searching -->
                <div
                    class="flex items-center gap-x-3 flex-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white">
                    <span class="material-symbols-outlined text-gray-500">search</span>
                    <input type="text" placeholder="Find Order" id="searchInput" onkeyup="searchTable()"
                        class="w-full outline-none text-gray-700 placeholder-gray-400 bg-transparent" />
                </div>
            </div>

            <!-- REPORT TABLE -->
            <div class="bg-white shadow-4xl h-[40em] mt-3 w-full relative rounded-2xl">
                <div class="overflow-y-auto h-full mb-4 rounded-2xl">
                    <table class="table-auto w-full" id="dataTable">
                        <thead class="border-b-2 border-tertiary text-white bg-[#747474] h-[3rem] w-full">
                            <tr class="text-center text-sm rounded-lg">
                                <th class="p-3">Action</th>
                                <th class="p-6">Transaction ID</th>
                                <th class="p-6">Cassa</th>
                                <th class="p-6">Date</th>
                                <th class="p-6">Amount</th>
                                <th class="p-6">Orders</th>
                                <th class="p-6">Payment Method</th>
                                <th class="p-6">Types Orders</th>
                            </tr>
                        </thead>

                        <tbody class="" id="tableBody">
                            @foreach($sales as $sl)
                            <tr class="border-b border-tertiary h-[3rem] text-center" data-date="2025-05-23"
                                data-user="{{  optional($sl->user)->username }}">
                                <td class="p-3">
                                    <div class="flex justify-center">
                                        <button
                                            class="bg-[#4682EC] text-white px-3 py-2 shadow flex justify-center items-center rounded-l-xl"
                                            onclick="showModal('modalViewItem')">
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>
                                        </button>
                                        <button
                                            class="bg-[#D9534F] text-white px-3 py-2 shadow flex justify-center items-center rounded-r-xl"
                                            onclick="showModal('modalDeleteItem')">
                                            <span class="material-symbols-outlined">
                                                cancel
                                            </span>
                                        </button>
                                    </div>
                                </td>
                                <td class="p-4">#{{ $sl->id }}</td>
                                <td class="p-4">{{ optional($sl->user)->username }}</td>
                                <td class="p-4">{{ $sl->sale_date }}</td>
                                <td class="p-4 font-bold">{{ $sl->quantity }}</td>
                                <td class="p-4">Rp. {{ $sl->total }}</td>
                                <td class="p-4">{{ $sl->payment }}</td>
                                <td class="p-4">
                                    <button class="p-3 bg-primary rounded-lg text-white cursor-pointer w-[80%]">
                                        {{ $sl->type }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <!-- Search icon -->
                        @if ($sales->isEmpty())
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center">
                            <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                            <p class="my-12 text-lg text-center">We can’t find any item matching your search</p>
                        </div>
                        @endif

                        <div id="noData" style="display: none;"
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center">
                            <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                            <p class="my-12 text-lg text-center">We can’t find any item matching your search</p>
                        </div>
                    </table>
                </div>

            </div>
            <!-- REPORT TABLE END -->
        </section>
        <!-- Modal Delete Item -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalDeleteItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Content -->
                <div class="mt-4 flex flex-col gap-y-2 py-2">
                    <h1 class="text-3xl font-bold text-primary mb-2">Delete History</h1>
                    <p class="text-lg text-gray-800">
                        Deleting <span class="font-bold">Transaction ID #000009</span> as
                        <span class="text-primary font-bold">Void</span>. This cannot be
                        undone.
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-end gap-x-4">
                    <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                        onclick="closeModal('modalDeleteItem')">
                        Close
                    </button>
                    <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal View Item -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalViewItem">
            <!-- Modal Box -->
            <div
                class="bg-white w-[400px] h-[500px] absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 rounded-2xl shadow-lg p-6 overflow-y-auto">
                <!-- Title -->
                <h2 class="text-center text-xl font-bold text-primary mb-1">
                    Detail Transaction
                </h2>
                <p class="text-center font-semibold text-gray-800 mb-4">
                    Transaction ID <span class="font-bold">#00000009</span>
                </p>

                <!-- Transaction Details -->
                <div class="space-y-4 text-sm text-gray-800">
                    <div class="flex justify-between border-b pb-1">
                        <span>Casier Name</span>
                        <span class="font-medium">Davetron Aljabar</span>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <span>Date Transaction</span>
                        <span class="font-medium">23/05/2025</span>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <span>Nama Costumer</span>
                        <span class="font-medium">Dave Aljabar</span>
                    </div>
                    <div class="border-b pb-1">
                        <span class="block mb-1">Item Name</span>
                        <div class="text-right leading-tight font-medium">
                            <p>Steak Sapi Bakar 1x</p>
                            <p>Ayam Kentang 2x</p>
                            <p>Energen Es 1x</p>
                        </div>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <span>Payment Method</span>
                        <span class="font-medium">Cash</span>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <span>Type Orders</span>
                        <span class="font-medium">Go Away</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Amount</span>
                        <span class="font-medium">Rp20.000</span>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="border-2 border-primary text-primary px-2 py-1 rounded hover:bg-primary hover:text-white"
                        onclick="closeModal('modalViewItem')">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/src/js/report.js"></script>
</body>

</html>