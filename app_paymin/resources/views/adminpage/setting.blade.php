<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/settings.css" />
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

        <!-- Main Content -->
        <section class="h-full w-full p-11 box-border overflow-y-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-[36pt] font-bold text-[#353535]">Settings</h1>
            </div>
            <div class="flex items-center w-full h-full p-4 gap-12">
                <!-- Navigation -->
                <div class="flex flex-col items-center w-auto h-full bg-white rounded-lg shadow-4xl flex-1">
                    <!-- Your Restaurant -->
                    <div class="flex items-center w-full h-auto p-4 hover:text-primary cursor-pointer transition-all duration-300 ease-in-out"
                        onclick="showYourRestaurant()">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-2">
                            <span class="material-symbols-outlined"> person </span>
                        </div>
                        <div>
                            <h1 class="text-lg font-medium">Your Profile</h1>
                            <p class="font-light">Configure you account</p>
                        </div>
                    </div>
                    <!-- Security -->
                    <div class="flex items-center w-full h-auto p-4 hover:text-primary cursor-pointer transition-all duration-300 ease-in-out"
                        onclick="showSecurity()">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-2">
                            <span class="material-symbols-outlined"> lock </span>
                        </div>
                        <div>
                            <h1 class="text-lg font-medium">Security</h1>
                            <p class="font-light">Configure Password, PIN, etc</p>
                        </div>
                    </div>
                    <!-- About Us -->
                    <div class="flex items-center w-full h-auto p-4 hover:text-primary cursor-pointer transition-all duration-300 ease-in-out"
                        onclick="showAboutUs()">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-2">
                            <span class="material-symbols-outlined"> error </span>
                        </div>
                        <div>
                            <h1 class="text-lg font-medium">About Us</h1>
                            <p class="font-light">Find out more about PayMin</p>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="bg-white rounded-xl shadow-md p-6 flex-2 mx-auto flex flex-col h-full w-full"
                    id="yourRestaurant">
                    <!-- Title -->
                    <h1 class="font-semibold text-gray-700 mb-4">
                        Your Profile
                    </h1>

                    <!-- Profile Info -->
                    <div class="flex h-auto w-full mx-5 items-center">
                        <!-- Profile Picture -->
                        <div class="relative w-40 h-40 mb-2">
                            <img src="" class="rounded-full w-full h-full object-cover bg-gray-200" />
                            <!-- Edit Icon -->
                            <button
                                class="absolute bottom-1 right-1 bg-primary text-white rounded-full p-1.5 shadow-md hover:bg-orange-600"
                                onclick="showModal('uploadImageModal')">
                                <span class="material-symbols-outlined leading-none align-middle">
                                    edit
                                </span>
                            </button>
                        </div>

                        <!-- Name & Date -->
                        <div class="flex flex-col justify-center ml-4 text-lg">
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-gray-500">Last updated: {{ $user->updated_at }}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <div class="flex flex-col justify-center ml-4 text-lg">
                        <p class="font-semibold text-gray-800">Bio</p>
                        <p class="text-gray-500">{{ $user->bio ?? 'Bio is empty' }}</p>
                    </div>

                    <!-- Buttons -->
                    <!-- <div class="flex justify-end space-x-2 mt-auto">
                        <button
                            class="border border-orange-500 text-orange-500 rounded px-4 py-2 hover:bg-orange-50 text-sm font-medium">
                            Cancel
                        </button>
                        <button
                            class="bg-gradient-to-r from-orange-500 to-orange-700 text-white rounded px-4 py-2 hover:from-orange-600 hover:to-orange-800 text-sm font-medium">
                            Save Changes
                        </button>
                    </div> -->
                </div>
                <!-- Security -->
                <div class="bg-white rounded-xl p-6 h-full flex-2 shadow-4xl hidden" id="security">
                    <!-- Header -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Security</h2>
                    <p class="text-sm text-gray-500 mb-6">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusant ium doloremque laudantium, totam remad aperiam eaque ipsa
                        quae ab illo inventore.
                    </p>

                    <!-- Change Password Section -->
                    <form class="space-y-4" action="{{ route('SysUpdatePassword') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Old Password</label>
                            <input type="password" id="old_password" placeholder="Enter old password"
                                name="old_password"
                                class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>

                        <div class="relative mt-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" id="new_password" placeholder="Enter new password"
                                name="new_password"
                                class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>

                        <div class="relative mt-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Repeat Password</label>
                            <input type="password" id="new_password_repeat" placeholder="Enter new repeat password"
                                name="new_password_repeat"
                                class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                        </div>


                        <!-- Buttons -->
                        <div class="flex justify-end space-x-4 pt-4">
                            <button type="submit"
                                class="bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-orange-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                <!-- About Us -->
                <div class="bg-white rounded-xl p-6 h-full flex-2 shadow-4xl hidden" id="aboutUs">
                    <!-- Header -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">About Us</h2>

                    <!-- Logo and Name -->
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="assets/src/assets/logoMin.png" alt="Logo" class="w-10 h-10 rounded-sm" />
                        <span class="text-2xl font-bold">
                            <span class="text-gray-800">Pay</span><span class="text-primary">Min</span>
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                        PayMin is a smart and easy-to-use Point of Sale (POS) system
                        designed to help small businesses manage sales, inventory, and
                        payments in one place. From retail stores to cafés, PayMin makes
                        transactions fast, inventory tracking simple, and reporting clear.
                    </p>

                    <p class="text-sm text-gray-600 leading-relaxed mb-4">
                        Our mission is to make business operations more efficient and
                        accessible for everyone. With PayMin, you can focus less on
                        managing tools — and more on growing your business. Simple.
                        Reliable. Built for your business.
                    </p>

                    <p class="text-sm font-semibold text-gray-800">
                        Simple. Reliable. Built for your business.
                    </p>
                </div>
            </div>

            <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
                id="uploadImageModal">
                <div
                    class="bg-white rounded-lg shadow-lg w-auto h-auto p-6 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 scale-95 transition-all duration-300 ease-in-out modal-content">
                    <!-- Form dengan action yang benar untuk user ini -->
                    <form action="{{ route('SysEditProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h1 class="text-3xl font-bold text-red-500 mb-2">Edit Profile</h1>
                        <div class="flex flex-col items-center">
                            <div
                                class="relative w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-300 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                            <button
                                class="flex items-center mt-2 text-gray-700 bg-transparent border-none focus:outline-none cursor-pointer hover:text-gray-900 transition-colors duration-200"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span class="text-sm font-medium">Edit Picture</span>
                            </button>
                        </div>

                        <div class="mt-4">

                            <label class="block text-sm font-medium text-gray-700 mt-4">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                            <label class="block text-sm font-medium text-gray-700 mt-4">Username</label>
                            <input type="text" name="username" value="{{ $user->username }}"
                                class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" />

                            <label class="block text-sm font-medium text-gray-700 mt-4">Bio</label>
                            <textarea type="text" name="bio"
                                class="mt-1 p-1 block w-[23vw] border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ $user->bio }}
                            </textarea>
                        </div>
                        <div class="mt-6 flex justify-center gap-x-4">
                            <button type="button" class="border-2 border-primary text-primary px-4 py-2 rounded"
                                onclick="closeModal('uploadImageModal')">
                                Close
                            </button>
                            <button class="bg-primary text-white px-4 py-2 rounded" type="submit">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/src/js/settings.js"></script>
</body>

</html>