<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/masterkey.css" />
    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon" />
    <title>PayMin</title>

    <link rel="shortcut icon" href="/src/assets/logoMin.png" type="image/x-icon" />

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
            <div class="mb-8">
                <h1 class="text-[36pt] font-bold text-[#353535]">Membership Data</h1>
            </div>

            <div class="flex gap-4 w-full justify-between items-center">
                <!-- Tombol CSV (col-1) -->
                <div class="">
                    <a href="{{ route('exportCSVMember') }}"
                        class="text-textColor px-4 py-2 bg-white shadow-sm rounded-lg w-full flex items-center justify-center hover:opacity-80 transition-all duration-200">
                        <span class="material-symbols-outlined">download</span> CSV
                    </a>
                </div>

                <!-- Form Search (col-10) -->
                <div class="w-full">
                    <form class="w-full">
                        <div class="relative w-full">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" placeholder="Find Members" id="searchInput" onkeyup="searchTable()"
                                class="border border-gray-300 rounded-2xl pl-10 pr-4 py-3 bg-white w-full focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- REPORT TABLE -->

            <div class="mt-3 bg-white shadow-4xl h-[40em] w-full relative rounded-2xl">
                <div class="overflow-y-auto h-full mb-4 rounded-2xl">
                    <table class="table-auto w-full" id="dataTable">
                        <thead class="border-b-2 border-tertiary text-white bg-[#747474] h-[3rem] w-full">
                            <tr class="text-center text-sm rounded-lg">
                                <th class="p-6">Member ID</th>
                                <th class="p-6">Name</th>
                                <th class="p-6">Date</th>
                                <th class="p-6">Amount</th>
                                <th class="p-6">Point</th>
                                <th class="p-6">No.Telp</th>
                                <th class="p-6">Types Member</th>
                            </tr>
                        </thead>

                        <tbody id="memberTableBody">
                            @foreach ($members as $m)
                            <tr class="border-b border-tertiary h-[3rem] text-center">
                                <td class="p-3">#{{ $m->id }}</td>
                                <td class="p-3">{{ $m->customer->name ?? '-' }}</td>
                                <td class="p-3">{{ $m->created_at }}</td>
                                <td class="p-3 font-bold">Rp {{ $m->amount }}</td>
                                <td class="p-3">{{ $m->points }}</td>
                                <td class="p-3">{{ $m->customer->phone ?? '-' }}</td>
                                <td class="p-3">
                                    @if ($m->type == 'Gold')
                                    <button class="bg-[#F0AD4E] text-white h-10 w-32 cursor-pointer rounded-full">
                                        Gold
                                    </button>
                                    @elseif ($m->type == 'Silver')
                                    <button class="bg-primary text-white h-10 w-32 cursor-pointer rounded-full">
                                        Silver
                                    </button>
                                    @elseif ($m->type == 'Platinum')
                                    <button class="bg-[#6A5DDE] text-white h-10 w-32 cursor-pointer rounded-full">
                                        Platinum
                                    </button>
                                    @elseif ($m->type == 'Expired')
                                    <button class="bg-tertiary text-white h-10 w-32 cursor-pointer rounded-full">
                                        Expired
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Search icon -->
                    @if ($members->isEmpty())
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center">
                        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                        <p class="my-12 text-lg">
                            We can’t find any item matching your search
                        </p>
                    </div>
                    @endif
                    <div id="noDataFound"
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center hidden">
                        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                        <p class="my-12 text-lg">
                            We can’t find any item matching your search
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/src/js/member.js"></script>
</body>

</html>