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

    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon" />

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

                        <tbody id="tableBody">
                            @foreach ($members as $m)
                            <tr class="border-b border-tertiary h-[3rem] text-center hidden">
                                <td class="p-3">#00000009</td>
                                <td class="p-3">Ridho&Harits</td>
                                <td class="p-3">23/05/2025</td>
                                <td class="p-3 font-bold">Rp 200.000</td>
                                <td class="p-3">1</td>
                                <td class="p-3">082248386580</td>
                                <td class="p-3">
                                    <button class="bg-[#F0AD4E] text-white h-10 w-32 cursor-pointer rounded-full">
                                        Gold
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Search icon -->
                    @if ($members)
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center">
                        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                        <p class="my-12 text-lg">
                            We can’t find any item matching your search
                        </p>
                    </div>
                    @endif
                    <div id="noData" style="display: none;"
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center">
                        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                        <p class="my-12 text-lg">
                            We can’t find any item matching your search
                        </p>
                    </div>
                </div>

                <!-- Footer Pagination -->
                <div class="absolute bottom-0 left-0 right-0 flex justify-end items-center p-4 bg-white rounded-b-2xl">
                    <!-- Pagination -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Page</span>
                        <button
                            class="px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-primary hover:text-white transition"
                            aria-label="Previous page">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button
                            class="px-3 py-1 rounded hover:bg-primary text-textColor hover:text-white font-semibold">
                            1
                        </button>
                        <button
                            class="px-3 py-1 rounded hover:bg-primary text-textColor hover:text-white font-semibold">
                            2
                        </button>
                        <button
                            class="px-3 py-1 rounded hover:bg-primary text-textColor hover:text-white font-semibold">
                            3
                        </button>
                        <button
                            class="px-3 py-1 rounded hover:bg-primary text-textColor hover:text-white font-semibold">
                            4
                        </button>
                        <button
                            class="px-3 py-1 rounded hover:bg-primary text-textColor hover:text-white font-semibold">
                            5
                        </button>
                        <button
                            class="px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-primary hover:text-white transition"
                            aria-label="Next page">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Edit Item -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalEditItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Content -->
                <h1 class="text-3xl font-bold text-red-500 mb-2">Edit Master</h1>
                <div class="flex flex-col items-center">
                    <!-- Profile Picture Circle -->
                    <div
                        class="relative w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-300 flex items-center justify-center">
                        <!-- User Icon Silhouette -->
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>

                    <!-- Edit Button (now a proper button element) -->
                    <button
                        class="flex items-center mt-2 text-gray-700 bg-transparent border-none focus:outline-none cursor-pointer hover:text-gray-900 transition-colors duration-200"
                        onclick="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="text-sm font-medium">Edit Picture</span>
                    </button>
                </div>

                <div class="mt-4">
                    <label for="itemName" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemName" class="block text-sm font-medium text-gray-700">Employee ID</label>
                    <input type="number" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Username</label>
                    <input type="text" id="itemStock"
                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                    <input type="password" id="itemPrice"
                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-center gap-x-4">
                    <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                        onclick="closeModal('modalEditItem')">
                        Close
                    </button>
                    <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalAddItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Content -->
                <h1 class="text-3xl font-bold text-red-500 mb-2">Add Master</h1>
                <div class="flex flex-col items-center">
                    <!-- Profile Picture Circle -->
                    <div
                        class="relative w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-300 flex items-center justify-center">
                        <!-- User Icon Silhouette -->
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>

                    <!-- Edit Button (now a proper button element) -->
                    <button
                        class="flex items-center mt-2 text-gray-700 bg-transparent border-none focus:outline-none cursor-pointer hover:text-gray-900 transition-colors duration-200"
                        onclick="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="text-sm font-medium">Edit Picture</span>
                    </button>
                </div>

                <div class="mt-4">
                    <label for="itemName" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemName" class="block text-sm font-medium text-gray-700">Employee ID</label>
                    <input type="number" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="itemName"
                        class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Username</label>
                    <input type="text" id="itemStock"
                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                    <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                    <input type="password" id="itemPrice"
                        class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-center gap-x-4">
                    <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                        onclick="closeModal('modalAddItem')">
                        Discard
                    </button>
                    <button class="bg-primary text-white px-4 py-2 rounded" id="submitBtn">
                        Add New
                    </button>
                </div>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalDeleteItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Content -->
                <div class="mt-4 flex flex-col gap-y-2 py-2">
                    <h1 class="text-3xl font-bold text-red-500 mb-2">Delete Master</h1>
                    <p class="text-lg text-gray-800">
                        Deleting <span class="font-bold">Master ID #000009</span>. This
                        cannot be undone.
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

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md flex justify-center items-center z-50 animate-fadeIn hidden"
            id="modalViewItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-xl shadow-lg w-96 p-6 mx-4 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Header -->
                <h1 class="text-2xl font-bold text-red-500 text-center mb-4">
                    View Master
                </h1>

                <!-- Modal Content -->
                <div class="flex flex-col items-center">
                    <!-- Profile Picture -->
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center mb-3">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>

                    <!-- Name and Role -->
                    <h2 class="text-lg font-medium text-gray-800 mb-1">Eren Jaegar</h2>
                    <div class="bg-gray-500 text-white text-xs px-4 py-1 rounded-full mb-6">
                        Anggota
                    </div>

                    <!-- Profile Details -->
                    <div class="w-full space-y-3 mb-6">
                        <!-- Employee ID -->
                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Employee ID</span>
                            <span class="text-gray-500">#20000045</span>
                        </div>

                        <!-- Nama -->
                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Nama</span>
                            <span class="text-gray-500">Eren Jaegar</span>
                        </div>

                        <!-- Username -->
                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Username</span>
                            <span class="text-gray-500">ereneren</span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-center">
                    <button
                        class="border border-red-500 text-red-500 px-8 py-2 rounded hover:bg-red-50 transition-colors duration-200"
                        onclick="closeModal('modalViewItem')">
                        Close
                    </button>
                </div>
            </div>
        </div>
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
    </main>
    <script src="assets/src/js/member.js"></script>
</body>

</html>