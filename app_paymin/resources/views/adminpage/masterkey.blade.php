<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/pages/master.html" />

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
            <div class="flex items-center justify-center mb-2">
                <img src="assets/src/assets/logoMin.png" alt="Logo" class="w-20 h-w-20 rounded-full" />
            </div>
            <ul id="navbar-list" class="flex flex-col h-full w-full relative z-10">
                <!-- Daftar item navigasi utama -->
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="/src/pages/home.html" class="flex flex-col items-center justify-center">
                        <i class="fa fa-home fa-2x"></i>

                        <p class="text-sm">Home</p>
                    </a>
                </li>
                <li
                    class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer">
                    <a href="{{ route('Order') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-cart-plus fa-2x"></i>
                        <p class="text-sm">Orders</p>
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
                    <a href="{{ route('Master') }}" class="flex flex-col items-center justify-center">
                        <i class="fa fa-key fa-2x"></i>
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
                <li
                    class="flex flex-col items-center justify-center mt-[4em] text-[#8B8B8B] hover:text-red-400 cursor-pointer">
                    <a class="flex flex-col items-center justify-center" onclick="showModal('modalLogout')">
                        <i class="fa fa-sign-out fa-2x"></i>
                        <p class="text-sm">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <section class="h-full w-full p-11 box-border overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-[36pt] font-bold text-[#353535]">Master Key</h1>
            </div>

            <div class="grid grid-cols-12 gap-4 w-full items-center">
                <!-- Tombol Add New (col-1) -->
                <div class="col-span-2">
                    <button
                        class="bg-primary text-textColor px-4 py-2 rounded-lg w-full flex items-center justify-center hover:opacity-80 transition-all duration-200"
                        onclick="showModal('modalAddItem')">
                        <span class="material-symbols-outlined">add_circle</span> Add New
                    </button>
                </div>

                <!-- Tombol CSV (col-1) -->
                <div class="col-span-1">
                    <button
                        class="text-textColor px-4 py-2 bg-white shadow-sm rounded-lg w-full flex items-center justify-center hover:opacity-80 transition-all duration-200"
                        onclick="showModal('')">
                        <span class="material-symbols-outlined">download</span> CSV
                    </button>
                </div>

                <!-- Form Search (col-10) -->
                <div class="col-span-9">
                    <form class="w-full">
                        <div class="relative w-full">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" placeholder="Find Items"
                                class="border border-gray-300 rounded-2xl pl-10 pr-4 py-3 bg-white w-full focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- REPORT TABLE -->

            <div class="mt-3 bg-white shadow-4xl h-[40em] w-full relative rounded-2xl">
                <div class="overflow-y-auto h-full mb-4 rounded-2xl">
                    <table class="table-auto w-full">
                        <thead class="border-b-2 border-tertiary text-white bg-[#747474] h-[3rem] w-full">
                            <tr class="text-center text-sm rounded-lg">
                                <th class="p-6">Action</th>
                                <th class="p-6">Employee ID</th>
                                <th class="p-6">Name</th>
                                <th class="p-6">Username</th>
                                <th class="p-6">Position</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($masterdata as $md)
                            <tr class="border-b border-tertiary h-[3rem] text-center">
                                <td class="p-3 w-[12em]">
                                    <div class="flex justify-center items-center">
                                        <button
                                            class="bg-[#4682EC] text-white px-4 py-2 flex justify-between items-center hover:opacity-80 transition-all duration-200 cursor-pointer rounded-l-2xl"
                                            onclick="showViewModal(this)" data-id="{{ $md->id }}"
                                            data-name="{{ $md->name }}" data-username="{{ $md->username }}"
                                            data-role="{{ $md->role }}" data-photo="{{ $md->photo }}">
                                            <div class="flex items-center">
                                                <span class="material-symbols-outlined">visibility</span>
                                            </div>
                                        </button>
                                        <button
                                            class="bg-[#F0AD4E] text-white px-4 py-2 flex justify-between items-center hover:opacity-80 transition-all duration-200 cursor-pointer"
                                            onclick="fillAndShowEditModal(this)" data-id="{{ $md->id }}"
                                            data-name="{{ $md->name }}" data-username="{{ $md->username }}"
                                            data-role="{{ $md->role }}">
                                            <div class="flex items-center">
                                                <span class="material-symbols-outlined">edit</span>
                                            </div>
                                        </button>
                                        <button
                                            class="bg-[#D9534F] text-white px-4 py-2 flex justify-between items-center hover:opacity-80 transition-all duration-200 cursor-pointer rounded-r-2xl"
                                            onclick="setDeleteId({{ $md->id }}); showModal('modalDeleteItem')">
                                            <div class="flex items-center">
                                                <span class="material-symbols-outlined">
                                                    cancel
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                                <td class="p-3">#{{$md->id}}</td>
                                <td class="p-3">{{$md->name}}</td>
                                <td class="p-3">{{$md->username}}</td>
                                <td class="p-3">
                                    @if ($md->role == 'admin')
                                    <button class="bg-primary text-white py-2 px-6 cursor-pointer rounded-full">
                                        Admin
                                    </button>
                                    @else
                                    <button class="bg-tertiary text-white py-2 px-6 cursor-pointer rounded-full">
                                        Kasir
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                <form action="{{ route('SysEditMaster', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <select name="role" id="editRole"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option value="" hidden></option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                        <label for="itemName" class="block text-sm font-medium text-gray-700 mt-4">Employee ID</label>
                        <input type="number" id="editId"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="#098712" disabled />

                        <label for="itemName" class="block text-sm font-medium text-gray-700 mt-4">Nama</label>
                        <input type="text" id="editName"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                        <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Username</label>
                        <input type="text" id="editUsername"
                            class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                        <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                        <input type="password" id="editPassword"
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
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalAddItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <!-- Modal Content -->
                <h1 class="text-3xl font-bold text-red-500 mb-2">Add Master</h1>
                <form action="{{ route('SysAddMaster') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-center">
                        <!-- Profile Picture Circle -->
                        <div class="relative w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-300 overflow-hidden">
                            <img id="previewImage" src="assets/src/assets/user.png"
                                class="w-full h-full object-cover rounded-full">
                        </div>

                        <!-- Hidden File Input -->
                        <input type="file" id="profilePictureInput" name="photo" accept="image/png" class="hidden"
                            onchange="handleImageUpload(event)">

                        <!-- Edit Button -->
                        <button type="button"
                            class="flex items-center mt-2 text-gray-700 bg-transparent border-none focus:outline-none cursor-pointer hover:text-gray-900 transition-colors duration-200"
                            onclick="document.getElementById('profilePictureInput').click()">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg> -->
                            <span class="text-sm font-medium">Edit Picture</span>
                        </button>
                    </div>


                    <div class="mt-4">
                        <label for="itemName" class="block text-sm font-medium text-gray-700">Posision</label>
                        <select name="role" id="role"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                            <option hidden></option>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>

                        <label for="itemName" class="block text-sm font-medium text-gray-700 mt-4">Employee ID</label>
                        <input type="number"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder=" automatic fill" disabled />

                        <label for="itemName" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                        <label for="itemStock" class="block text-sm font-medium text-gray-700 mt-4">Username</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                        <label for="itemPrice" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-center gap-x-4">
                        <button class="border-2 border-primary text-primary px-4 py-2 rounded"
                            onclick="closeModal('modalAddItem')">
                            Discard
                        </button>
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded" id="submitBtn">
                            Add New
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="modalDeleteItem">
            <!-- Modal Container -->
            <div
                class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                <form action="{{ route('SysDeleteMaster') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="deleteIdInput">

                    <div class="mt-4 flex flex-col gap-y-2 py-2">
                        <h1 class="text-3xl font-bold text-red-500 mb-2">Delete Master</h1>
                        <p class="text-lg text-gray-800">
                            Deleting <span class="font-bold">Master ID #<span id="deleteIdText">000000</span></span>.
                            This
                            cannot be undone.
                        </p>
                    </div>

                    <!-- Modal Footer -->
                    <div class="mt-6 flex justify-end gap-x-4">
                        <button class="border-2 border-primary text-primary px-4 py-2 rounded" type="button"
                            onclick="closeModal('modalDeleteItem')">
                            Close
                        </button>
                        <button class="bg-primary text-white px-4 py-2 rounded" type="submit">
                            Delete
                        </button>
                    </div>
                </form>
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
                    <div
                        class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center mb-3 overflow-hidden">
                        <img id="modalViewPhoto" src="" class="w-full h-full object-cover" />
                    </div>

                    <!-- Name and Role -->
                    <h2 class="text-lg font-medium text-gray-800 mb-1" id="modalViewName">Nama</h2>
                    <div id="modalViewRole">
                        Role
                    </div>

                    <!-- Profile Details -->
                    <div class="w-full space-y-3 mb-6">
                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Employee ID</span>
                            <span class="text-gray-500" id="modalViewId">#000000</span>
                        </div>

                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Nama</span>
                            <span class="text-gray-500" id="modalViewNameDetail">Nama</span>
                        </div>

                        <div class="flex justify-between gap-x-8">
                            <span class="text-gray-700">Username</span>
                            <span class="text-gray-500" id="modalViewUsername">username</span>
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
        <!-- </div> -->
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/src/js/script.js"></script>
    <script>
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = modal.querySelector(".modal-content");

        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove("opacity-0", "scale-95");
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = modal.querySelector(".modal-content");

        modalContent.classList.add("opacity-0", "scale-95");
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 10);
    }

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Hanya izinkan PNG
        if (file.type !== "image/png") {
            alert("Hanya file PNG yang diperbolehkan!");
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function setDeleteId(id) {
        document.getElementById('deleteIdInput').value = id;
        document.getElementById('deleteIdText').innerText = id;
    }

    function showViewModal(button) {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const username = button.getAttribute('data-username');
        const role = button.getAttribute('data-role');
        const photo = button.getAttribute('data-photo');

        // Set teks
        document.getElementById('modalViewId').textContent = `#${id}`;
        document.getElementById('modalViewName').textContent = name;
        document.getElementById('modalViewNameDetail').textContent = name;
        document.getElementById('modalViewUsername').textContent = username;

        const roleEl = document.getElementById('modalViewRole');
        roleEl.textContent = role.charAt(0).toUpperCase() + role.slice(1);
        roleEl.className = role === 'admin' ?
            'bg-primary-500 text-white text-xs px-4 py-1 rounded-full mb-6 inline-block' :
            'bg-tertiary-500 text-white text-xs px-4 py-1 rounded-full mb-6 inline-block';

        // Set foto
        const photoEl = document.getElementById('modalViewPhoto');
        if (photo) {
            photoEl.src = `/storage/uploads/photos/${photo}`;
        } else {
            photoEl.src = `/assets/src/assets/user.png`;
        }

        // Tampilkan modal
        showModal('modalViewItem');
    }

    function fillAndShowEditModal(button) {
        // Ambil data dari tombol
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const username = button.getAttribute('data-username');
        const role = button.getAttribute('data-role');

        // Set nilai ke dalam modal
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editUsername').value = username;
        document.getElementById('editRole').value = role;

        // Kosongkan password (opsional)
        document.getElementById('editPassword').value = '';

        // Tampilkan modal
        showModal('modalEditItem');
    }

    function showModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    </script>
</body>

</html>