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
                    onclick="showModal('logoutModal')">
                    <a class="flex flex-col items-center justify-center">
                        <i class="fa fa-sign-out fa-2x"></i>
                        <p class="text-sm">Logout</p>
                    </a>
                </li>
            </ul>

            <!-- Logout Modal -->
            <div class="fixed inset-0 backdrop-blur-md bg-opacity-30 flex items-center justify-center z-50 hidden"
                id="logoutModal">
                <!-- Modal box -->
                <div class="bg-white rounded-xl p-6 w-72 text-center modal-content shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Do you want to Logout?
                    </h3>

                    <div class="text-4xl mb-5">
                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-center gap-4">
                        <button class="px-4 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-50"
                            onclick="closeModal('logoutModal')">
                            Cancel
                        </button>
                        <button class="px-4 py-2 bg-primary text-white rounded-md hover:opacity-90"
                            onclick="window.location.href='login.html'">
                            Yes
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <section class="h-full w-full p-11 box-border overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-[36pt] font-bold text-[#353535]">Orders History</h1>
            </div>

            <!-- <div class="flex gap-x-4">
                <div class="relative md:w-2/12 w-[15%]">
                    <button id="sortingDropdown" type="button"
                        class="flex justify-between items-center w-full px-5 py-2.5 bg-white rounded-xl shadow-sm text-left text-lg text-gray-800 cursor-pointer">
                        <span>Sorting By</span>
                        <span
                            class="border-gray-500 border-r-2 border-b-2 p-1 rotate-45 transition-transform duration-200"
                            id="arrow"></span>
                    </button> -->
            <!-- Dropdown Menu -->
            <!-- <div id="sortingMenu"
                        class="absolute top-full left-0 w-full mt-1 bg-white rounded-xl shadow-md z-10 hidden overflow-hidden">
                        <div class="dropdown-item py-4 px-5 cursor-pointer text-lg text-gray-800 bg-white hover:bg-primary hover:text-white"
                            data-sort="year">
                            By Year
                        </div>
                        <div class="dropdown-item py-4 px-5 cursor-pointer text-lg text-gray-800 bg-white hover:bg-primary hover:text-white"
                            data-sort="month">
                            By Month
                        </div>
                        <div class="dropdown-item py-4 px-5 cursor-pointer text-lg text-gray-800 bg-white hover:bg-primary hover:text-white"
                            data-sort="day">
                            By Day
                        </div>
                    </div>
                </div> -->

            <!-- <button id="sortingDropdown"
                    class="flex justify-between items-center w-[10%] px-5 py-2.5 bg-white rounded-xl shadow-sm text-left text-lg text-gray-800 cursor-pointer">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span>CSV</span>
                </button> -->
            </div>

            <div class="flex gap-4 py-6 w-full">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Beginning balance</p>
                        <p class="text-3xl font-bold text-gray-800">Rp. {{ number_format($beginningBalance, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Admission fee</p>
                        <p class="text-3xl font-bold text-gray-800">+Rp. {{ number_format($admissionFee, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-4xl w-full">
                    <div class="h-2 bg-primary rounded-t-lg"></div>
                    <div class="p-6">
                        <p class="text-xl text-gray-500">Money Out</p>
                        <p class="text-3xl font-bold text-gray-800">-Rp. {{ number_format($moneyOut, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex md:flex-row w-full">
                <div class="relative flex items-center">
                    <div class="relative w-60">
                        <select id="userFilter" onchange="filterByUser()"
                            class="appearance-none w-full bg-white border border-gray-300 text-gray-900 text-base px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option>All</option>
                            @foreach ($user as $s)
                            <option>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Chevron icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <span class="material-symbols-outlined">
                            keyboard_arrow_down
                        </span>
                    </div>
                </div>
                <a id="sortingDropdown" href="{{ route('exportCSVReport') }}"
                    class="flex justify-between items-center w-[10%] px-5 py-2.5 bg-white rounded-xl shadow-sm text-left text-lg text-gray-800 cursor-pointer">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span>CSV</span>
                </a>
                <!-- Search Form - 4/12 columns -->
                <form class="flex items-center gap-2 md:w-4/12 mb-4 md:mb-0">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="text" placeholder="Find Items" id="searchInput" onkeyup="searchTable()"
                            class="border border-gray-300 rounded-2xl pl-10 pr-4 py-3 bg-white w-full focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                </form>
            </div>

            <!-- REPORT TABLE -->
            <div class="bg-white shadow-4xl h-[40em] mt-3 w-full relative rounded-2xl">
                <div class="overflow-y-auto h-full mb-4 rounded-2xl">
                    <table class="table-auto w-full" id="dataTable">
                        <thead class="border-b-2 border-tertiary text-white bg-[#747474] h-[3rem] w-full">
                            <tr class="text-center text-sm rounded-lg">
                                <th class="p-6">Transaction ID</th>
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
                                <td class="p-4">#{{ $sl->user_id }}</td>
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
            id="modalAddItem" id="modalAddItem">
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
                        onclick="closeModal('modalAddItem')">
                        Close
                    </button>
                    <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/src/js/report.js"></script>
</body>

</html>