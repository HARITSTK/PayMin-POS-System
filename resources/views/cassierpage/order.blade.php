<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/src/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/src/css/order.css" />
    <link rel="shortcut icon" href="assets/src/assets/logoMin.png" type="image/x-icon" />
    <title>PayMin-Cashier</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Icons -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
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
            <div class="mb-8 w-full shadow-4xl rounded-xl bg-linear-[90deg,_#FFFFFF,_#E6EEFD] p-7">
                <h1 class="text-[22pt] font-bold text-[#353535]">
                    Pay<span class="text-primary">Min</span> CoffeShop
                </h1>
                <p class="text-textColor text-lg">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="flex justify-between w-full shadow-4xl rounded-xl bg-white px-5 py-2">
                <ul class="flex flex-row items-center gap-3">
                    <li
                        class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                        <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                            All
                        </button>
                    </li>
                    <li
                        class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                        <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                            Cake
                        </button>
                    </li>
                    <li
                        class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                        <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                            Drink
                        </button>
                    </li>
                    <li
                        class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]">
                        <button type="button" class="w-full h-full focus:outline-none cursor-pointer">
                            Food
                        </button>
                    </li>
                </ul>

                <form class="flex items-center gap-2">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="text" placeholder="Search food, coffe, etc..." id="searchInput"
                            onkeyup="searchTable()"
                            class="border border-gray-300 rounded-2xl pl-10 pr-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-4 auto-rows-auto gap-4 justify-items-center p-4 relative w-full h-full"
                id="orderList">
                @foreach ($product as $p)
                <div
                    class="flex flex-col items-center justify-center bg-white shadow-4xl rounded-xl cursor-pointer transition-all duration-200 p-6 w-full h-[50vh] relative mt-10 itemCard">
                    <div class="relative w-full h-full">
                        <img src="assets/src/assets/coffee.png" alt="Product"
                            class="rounded-full mb-3 absolute -top-20 left-1/2 transform -translate-x-1/2" />
                    </div>
                    <h2 class="text-2xl font-semibold item-name ">{{ $p->name }}</h2>
                    <div class="flex justify-between w-full mt-4">
                        <p class="text-tertiary">Stock</p>
                        <p class="text-textColor font-bold">{{ $p->stock }}</p>
                    </div>
                    <div class="flex justify-between w-full mt-2">
                        <p class="text-tertiary">Price</p>
                        <p class="text-primary font-bold">Rp. {{ $p->price }}</p>
                    </div>
                    <button
                        class="bg-linear-[180deg,_#FF5733,_#BB482F] w-full py-2 mt-5 rounded-lg text-white font-semibold toggleSidebarBtn"
                        onclick="addToOrder('{{ $p->id }}', '{{ $p->name }}', '{{ $p->price }}', '{{ asset('assets/src/assets/coffee.png') }}')">
                        Add
                    </button>
                </div>
                @endforeach

                <!-- Search icon -->
                <div id="noDataFound"
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center hidden">
                    <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                    <p class="my-12 text-lg">
                        We can’t find any item matching your search
                    </p>
                </div>
            </div>
        </section>

        <!-- Sidebar Ordered List -->
        <aside id="sidebarOrderedList"
            class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden">
            <div class="flex items-center justify-between w-full px-6 py-5">
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        1
                    </div>
                    <p class="text-textColor text-sm">Orders</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div
                        class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        2
                    </div>
                    <p class="text-textColor text-sm">Payment</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div
                        class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        3
                    </div>
                    <p class="text-textColor text-sm">Finish</p>
                </span>
            </div>
            <div class="flex items-center justify-between gap-4 my-2 w-full py-2 px-6">
                <div
                    class="flex justify-center font-light items-center gap-x-2 border-2 border-[#8B8B8B] rounded-xl px-4 py-2 text-[#8B8B8B] has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                    <form action="" class="flex items-center gap-2">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        <label for="dinein">Dine In</label>
                        <input type="checkbox" id="dinein" name="dinein" value="DineIn"
                            class="appearance-none w-4 h-4 rounded-full border-2 border-[#8B8B8B] checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                    </form>
                </div>
                <div
                    class="flex font-light justify-center items-center gap-x-2 border-2 border-[#8B8B8B] rounded-xl px-4 py-2 text-[#8B8B8B] has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                    <form action="" class="flex items-center gap-2">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <label for="togo">Take Away</label>
                        <input type="checkbox" id="takeaway" name="takeaway"
                            class="appearance-none w-4 h-4 rounded-full border-2 border-[#8B8B8B] checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                    </form>
                </div>
            </div>
            <div class="w-full px-6">
                <p class="text-textColor text-sm" id="orderMeta1">#Orders0021 | 23/05/2025 | 14:30</p>
                <hr class="w-full h-[1px] my-2 border-0 bg-tertiary" />
            </div>

            <div class="w-full px-6">
                <form class="max-w-md mx-auto bg-white">
                    <!-- Customer Name -->
                    <div>
                        <label for="name" class="block text-gray-800 text-[11pt]">Costumers Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-[#383838] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:border-primary p-1" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-gray-800 text-[11pt]">No Telephone</label>
                        <input type="number" id="phone" name="phone" required pattern="[0-9]{10,15}"
                            class="w-full border border-[#383838] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:border-primary p-1" />
                    </div>

                    <!-- Table Number -->
                    <div id="tableWrapper">
                        <label for="table" class="block text-gray-800 text-[11pt]">No.Table</label>
                        <select id="table" name="table" required
                            class="w-[50%] border border-[#383838] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:border-primary p-1 text-[11pt]">
                            <option hidden value="-">Select Table</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="w-full px-6 mt-4">
                <p class="text-textColor text-sm" id="orderMeta2">#Orders0021 | 23/05/2025 | 14:30</p>
                <hr class="w-full h-[1px] my-2 border-0 bg-tertiary" />
            </div>
            <!-- Orders -->
            <div id="orderedList" class="h-full w-full flex flex-col items-center mt-2 overflow-y-auto px-6">
                <div id="templateItem" class="hidden flex flex-col items-center w-full mt-2" data-id="">
                    <div class="flex flex-col items-center w-full mt-2">
                        <div class="flex justify-between w-full h-[60px]">
                            <div class="flex items-center justify-center w-[5em]">
                                <img src="assets/src/assets/coffee.png" alt="Coffee"
                                    class="productImage w-full object-cover h-full" />
                            </div>
                            <div class="w-auto">
                                <h1
                                    class="productName text-textColor text-lg font-semibold overflow-hidden text-ellipsis whitespace-nowrap w-[70%]">
                                    -
                                </h1>
                                <p class="productPrice text-textColor text-sm w-auto">Rp. -</p>
                            </div>
                            <div class="w-auto">
                                <h1 class="productSubtotal text-primary text-2xl font-bold">-</h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-1 w-full">
                            <button class="btnMinus bg-primary text-white rounded-md w-8 h-8 text-xl">-</button>
                            <span class="productQty text-lg font-semibold w-8 text-center">-</span>
                            <button class="btnPlus bg-primary text-white rounded-md w-8 h-8 text-xl">+</button>
                        </div>
                        <div class="flex justify-between items-center w-full h-12 mt-2">
                            <input type="text" placeholder="add note" id="note"
                                class="note border border-gray-300 rounded-md p-3 w-full text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                            <button
                                class="btnDelete text-tertiary hover:text-red-700 h-full rounded-md border-2 border-tertiary transition-colors duration-200 w-[20%]">
                                <i class="fa fa-trash fa-lg"></i>
                            </button>
                        </div>
                        <hr class="w-full h-[1px] my-6 border-0 bg-tertiary" />
                    </div>
                </div>
            </div>


            <div class="h-auto w-full flex flex-col justify-end bottom-0 p-4 shadow-continuePayment bg-white">
                <button
                    class="bg-linear-[180deg,_#FF5733,_#BB482F] orderNextButton-content text-white px-8 py-[0.80rem] rounded-lg text-lg font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 w-full"
                    type="button" onclick="orderNext()">
                    Continue Payment
                </button>
            </div>
        </aside>

        <!-- Sidebar Payment -->
        <aside id="sidebarPayment"
            class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden">
            <!-- Order Process -->
            <div class="flex items-center justify-between w-full px-6 py-5">
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        1
                    </div>
                    <p class="text-textColor text-sm">Orders</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        2
                    </div>
                    <p class="text-textColor text-sm">Payment</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div
                        class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        3
                    </div>
                    <p class="text-textColor text-sm">Finish</p>
                </span>
            </div>

            <!-- Select Payment -->
            <div class="w-full px-6 h-full relative overflow-y-auto" id="paymentMethod">
                <div id="NoMembership"
                    class="w-full h-32 border-2 border-dashed border-gray-400 rounded-xl flex items-center justify-center text-gray-500 italic text-sm hidden">
                    No membership yet
                </div>

                <!-- Silver Card -->
                <div class="w-full rounded-xl p-5 bg-linear-[-90deg,_#D9D9D9,_#B9B9B9] shadow-md relative flex items-center justify-between text-white border-[1px] border-[#929292] hidden"
                    id="cardSilver">
                    <div class="text-sm my-2">
                        <p>Name : <strong>Daveton Aljabar</strong></p>
                        <p>No.Tlp : <strong>08236538337</strong></p>
                        <p>Point : 2</p>
                    </div>
                    <div class="text-xs text-right">
                        <p class="mb-4 text-gray-900 font-light">Membership</p>
                        <span
                            class="bg-linear-[90deg,_#FF5733,_#B9B9B9] text-white px-3 py-2 rounded font-bold text-xs">SILVER</span>
                    </div>
                </div>

                <!-- Gold Card -->
                <div class="w-full rounded-xl p-5 bg-linear-[-90deg,_#FFE493,_#C7A028] shadow-md relative flex items-center justify-between text-white border-[1px] border-[#C79F28] hidden"
                    id="cardGold">
                    <div class="text-sm my-2">
                        <p>Name : <strong>Daveton Aljabar</strong></p>
                        <p>No.Tlp : <strong>08236538337</strong></p>
                        <p>Point : 2</p>
                    </div>
                    <div class="text-xs text-right">
                        <p class="mb-4 text-gray-900 font-light">Membership</p>
                        <span
                            class="bg-linear-[90deg,_#FF5733,_#C79F27] text-white px-3 py-2 rounded font-bold text-xs">GOLD</span>
                    </div>
                </div>

                <!-- Platinum Card -->
                <div class="w-full rounded-xl p-5 bg-linear-[-90deg,_#C0BBF3,_#6A5DDE] shadow-md relative flex items-center justify-between text-white border-[1px] border-[#6A5DDE] hidden"
                    id="cardPlatinum">
                    <div class="text-sm my-2">
                        <p>Name : <strong>Daveton Aljabar</strong></p>
                        <p>No.Tlp : <strong>08236538337</strong></p>
                        <p>Point : 2</p>
                    </div>
                    <div class="text-xs text-right">
                        <p class="mb-4 text-gray-900 font-light">Membership</p>
                        <span
                            class="bg-linear-[90deg,_#FF5733,_#776BE1] text-white px-2 py-2 rounded font-bold text-xs">PLATINUM</span>
                    </div>
                </div>

                <!-- Expired Card -->
                <div class="w-full rounded-xl p-5 bg-linear-[-90deg,_#D9D9D9,_#B9B9B9] shadow-md relative flex items-center justify-between text-white border-[1px] border-[#929292] hidden"
                    id="cardExpired">
                    <div class="text-sm my-2">
                        <p>Name : <strong class="memberName">-</strong></p>
                        <p>No.Tlp : <strong class="memberPhone">-</strong></p>
                        <p>Point : <span class="memberPoints">-</span></p>
                    </div>
                    <div class="text-xs text-right">
                        <p class="mb-4 text-gray-900 font-light">Membership</p>
                        <span
                            class="bg-linear-[90deg,_#FF5733,_#B9B9B9] text-white px-3 py-2 rounded font-bold text-xs">EXPIRED</span>
                    </div>
                </div>

                <!-- Update Membership -->
                <button id="UpdateMember"
                    class="w-auto h-auto px-4 py-2 ml-auto border-2 border-primary rounded-xl flex items-center justify-center text-primary hover:bg-primary hover:text-white italic text-sm mt-2 hidden"
                    onclick="showUpdateMembershipModal()">
                    Update
                </button>

                <!-- Select Payment -->
                <div class="flex flex-col p-3 gap-4 w-full h-auto">
                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-textColor">E-Wallet</h3>
                        <div class="flex flex-col gap-1">
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/logoShopeePay-01.png"
                                                alt="ShopeePay" class="w-full object-contain" />
                                        </div>
                                        <label for="ShopeePay">ShopeePay</label>
                                    </div>

                                    <input type="checkbox" id="ShopeePay" name="ShopeePay" value="ShopeePay"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/qris.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="Qris">Qris</label>
                                    </div>

                                    <input type="checkbox" id="Qris" name="Qris" value="Qris"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/dana.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="Dana">Dana</label>
                                    </div>

                                    <input type="checkbox" id="Dana" name="Dana" value="Dana"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-textColor">Other</h3>
                        <div class="flex flex-col gap-1">
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/cash.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="Cash">Cash</label>
                                    </div>

                                    <input type="checkbox" id="Cash" name="Cash" value="Cash"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-tertiary">
                            Card (Coming Soon)
                        </h3>
                        <div class="flex flex-col gap-1">
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/muamalat.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="Muamalat">Muamalat</label>
                                    </div>

                                    <input type="checkbox" id="Muamalat" name="Muamalat" value="Muamalat"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/bri.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="BRI">BRI</label>
                                    </div>

                                    <input type="checkbox" id="BRI" name="BRI" value="BRI"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                            <div
                                class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary">
                                <form action="/action_page.php" class="flex items-center justify-between w-full px-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        <div class="w-6 h-6">
                                            <img src="assets/src/assets/paymentIcons/bca.png" alt="ShopeePay"
                                                class="w-full object-contain" />
                                        </div>
                                        <label for="BCA">BCA</label>
                                    </div>

                                    <input type="checkbox" id="BCA" name="BCA" value="BCA"
                                        class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pay Orders -->
            <div class="relative h-[25%] w-full flex flex-col justify-end bottom-0 p-6 shadow-continuePayment bg-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-tertiary text-lg font-light">Tax</h1>
                    <p class="text-textColor text-sm w-auto" id="taxAmount">Rp. 20.000</p>
                </div>
                <div class="flex justify-between items-center" id="membershipCostSection" style="display: none;">
                    <h1 class="text-tertiary text-lg font-light">Update Membership</h1>
                    <p class="text-textColor text-sm w-auto" id="membershipCost">Rp. 0</p>
                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-tertiary text-lg font-light">Subtotal</h1>
                    <p class="text-textColor text-lg font-bold w-auto" id="subtotalAmount">Rp. 20.000</p>
                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-tertiary text-lg font-light">Total</h1>
                    <p class="text-textColor text-lg font-bold w-auto" id="totalAmount">Rp. 0</p>
                </div>
                <div class="flex justify-between mt-3 w-full">
                    <button
                        class="border-2 border-primary text-primary rounded-lg text-[11pt] font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 py-2 px-1 w-auto"
                        type="button" id="continuePaymentBtn" onclick="paymentBack()">
                        Back to Orders
                    </button>
                    <button
                        class="bg-linear-[180deg,_#FF5733,_#BB482F] text-white rounded-lg text-[11pt] font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 py-2 px-1 w-auto"
                        type="button" id="continuePaymentBtn" onclick="showInvoice()">
                        Continue Payment
                    </button>
                </div>
            </div>
        </aside>

        <!-- Sidebar Finish -->
        <aside id="sidebarFinish"
            class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden">
            <div class="flex items-center justify-between w-full px-6 py-5">
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        1
                    </div>
                    <p class="text-textColor text-sm">Orders</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        2
                    </div>
                    <p class="text-textColor text-sm">Payment</p>
                </span>
                <span class="flex flex-col font-light items-center">
                    <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">
                        3
                    </div>
                    <p class="text-textColor text-sm">Finish</p>
                </span>
            </div>

            <div class="w-full px-4 h-full relative overflow-y-auto" id="printOrder">
                <div class="flex flex-col gap-4 w-full h-auto">
                    <div class="bg-white relative rounded-2xl p-6 w-full h-auto shadow-4xl modal-content">
                        <h2 class="text-3xl font-semibold text-center mb-2">
                            Order confirmation
                        </h2>

                        <div class="flex justify-between text-sm mb-4">
                            <span id="finishOrderCode">#Orders0021</span>
                            <span id="finishOrderTime">23/05/2025 | 14:30</span>
                        </div>

                        <div class="overflow-y-auto h-[10em] mb-4">
                            <table class="table-fixed w-full text-[10px]">
                                <thead class="border-b-2 border-tertiary h-[3rem]">
                                    <tr>
                                        <th class="text-left">ITEM NAME</th>
                                        <th class="text-left">QTY</th>
                                        <th class="text-left">TAX</th>
                                        <th class="text-left">SUB TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody class="" id="sidebarItemList">
                                    <tr class="border-b border-tertiary h-[3rem]">
                                        <td>Steak Sapi bakar</td>
                                        <td>2</td>
                                        <td>Rp1.500</td>
                                        <td>Rp40.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bottom-0 left-0 w-full h-auto text-[12px]">
                            <div class="flex justify-between">
                                <div>
                                    <h1 class="font-light text-tertiary">Payment method:</h1>
                                    <div class="flex">
                                        <img id="sidebarPaymentIcon" src="assets/src/assets/paymentIcons/cash.png"
                                            alt="Cash" class="w-5 h-5 mr-2" />
                                        <span id="sidebarPaymentMethod">Cash</span>
                                    </div>
                                </div>

                                <table class="w-full mb-4 text-right">
                                    <tbody>
                                        <tr>
                                            <td class="py-1 text-tertiary">SUBTOTAL</td>
                                            <td class="py-1 text-right" id="sidebarSubtotal">Rp70.000</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 text-tertiary">ORDER DISCOUNT</td>
                                            <td class="py-1 text-right" id="sidebarDiscount">Rp0</td>
                                        </tr>
                                        <tr>
                                            <td class="py-1 text-tertiary">TAX</td>
                                            <td class="py-1 text-right" id="sidebarTax">Rp1.500</td>
                                        </tr>
                                        <tr id="sidebarCashRow" class="hidden">
                                            <td class="py-1 text-tertiary">CASH</td>
                                            <td class="py-1 text-right" id="sidebarCash">Rp0</td>
                                        </tr>
                                        <tr id="sidebarReturnRow" class="hidden">
                                            <td class="py-1 text-tertiary">RETURN</td>
                                            <td class="py-1 text-right" id="sidebarReturn">Rp1.500</td>
                                        </tr>
                                        <tr class="font-bold">
                                            <td class="py-1">BILL AMOUNT</td>
                                            <td class="py-1 text-right text-primary" id="sidebarTotal">Rp71.500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pay Orders -->
            <div class="relative h-auto w-full flex flex-col justify-end bottom-0 p-6">
                <div class="flex justify-end mt-3 w-full">
                    <button
                        class="bg-linear-[180deg,_#FF5733,_#BB482F] text-white px-8 py-[0.80rem] rounded-lg text-lg font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 w-full"
                        id="continuePaymentBtn" onclick="showPaymentProcessModal()">
                        Confirmation
                    </button>
                </div>
            </div>
        </aside>

        <!-- Invoice -->
        <div class="fixed inset-0 flex bg-black/25 items-center justify-center backdrop-blur-sm bg-opacity-50 z-50 hidden"
            id="modalInvoice">
            <!-- Modal -->
            <div class="bg-white w-[50%] h-auto rounded-xl shadow-lg p-6 space-y-4">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Table No.<br /><span class="text-2xl font-bold text-black" id="invoiceTableNo">234</span>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-semibold">Order confirmation</h2>
                        <p class="text-sm text-gray-500">Please confirm the order</p>
                    </div>
                    <div></div>
                </div>

                <!-- Order Info -->
                <div class="flex justify-between text-sm text-gray-500">
                    <span id="invoiceOrderCode">#Orders0021</span>
                    <span id="invoiceOrderTime">23/05/2025 | 14:30</span>
                </div>

                <!-- Table -->
                <div class="border rounded-lg">
                    <div class="grid grid-cols-4 bg-gray-100 p-2 text-sm font-semibold">
                        <div class="col-span-2">ITEM NAME</div>
                        <div>QTY</div>
                        <div class="text-right">SUBTOTAL</div>
                    </div>
                    <div class="divide-y text-sm">
                        <div class="grid grid-cols-4 p-2">
                            <div class="col-span-2" id="invoiceItemList">Steak sapi bakar</div>
                            <div id="invoiceItemQty">1</div>
                            <div class="text-right" id="invoiceItemTotalPrice">Rp20.500</div>
                        </div>
                    </div>
                </div>

                <div class="flex">
                    <!-- Notes -->
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold mb-1">NOTES</h3>
                        <p class="text-xs text-gray-500" id="noteItem"></p>
                    </div>

                    <!-- Summary -->
                    <div class="text-sm space-y-1 flex-1">
                        <div class="flex justify-between">
                            <span>SUBTOTAL</span>
                            <span id="invoiceSubtotal">Rp70.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>MEMBERSHIP DISCOUNT</span>
                            <span class="text-textColor" id="invoiceDiscount">-2.5%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>TAX</span>
                            <span id="invoiceTax">Rp2.000</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-primary">
                            <span>BILL AMOUNT</span>
                            <span id="invoiceTotal">Rp71.500</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <img src="https://img.icons8.com/color/48/000000/cash-in-hand.png"
                        class="w-6 h-6 payment-method-icon" />
                    <span class="payment-method-name">Cash</span>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button class="px-4 py-2 rounded-md border border-primary text-primary hover:bg-red-50"
                        onclick="closeModal('modalInvoice')">
                        Cancel
                    </button>
                    <button class="px-4 py-2 rounded-md bg-primary text-white hover:bg-primary"
                        onclick="prepareInvoice()">
                        Confirm
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Order Finish -->
        <div id="modalInputCash"
            class="fixed bg-black/25 inset-0 flex items-center justify-center backdrop-blur-md bg-opacity-50 z-100 w-full animate-fadeIn hidden">
            <div class="bg-white relative rounded-2xl p-16 w-[50vw] h-[50vh] shadow-lg flex flex-col ">
                <!-- Processing section -->
                <div class="flex flex-col w-full h-full my-auto px-6 py-4 bg-white rounded-2xl">
                    <h2 class="text-3xl font-semibold mb-4 text-gray-800">Input Payment Method (Cash)</h2>

                    <label for="cashInput" class="text-sm font-medium text-gray-600 mb-2">
                        Enter Cash Amount
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            Rp
                        </span>
                        <input type="number" id="cashInput" name="cashInput" placeholder="0"
                            class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-lg transition-all duration-200" />
                    </div>

                    <p id="cashValidationMsg" class="mt-2 text-sm text-red-500 hidden">Insufficient cash amount.</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button class="px-4 py-2 rounded-md border border-primary text-primary hover:bg-red-50"
                        onclick="closeModal('modalInputCash')">
                        Cancel
                    </button>
                    <button class="px-4 py-2 rounded-md bg-primary text-white hover:bg-primary"
                        onclick="handleCashInput()">
                        Confirm Payment
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Order Finish -->
        <div id="modalOrderFinish"
            class="fixed hidden bg-black/25 inset-0 flex items-center justify-center backdrop-blur-md bg-opacity-50 z-100 w-full animate-fadeIn">
            <div class="bg-white relative rounded-2xl p-16 w-[50vw] h-[80vh] shadow-lg flex flex-col items-center">
                <!-- Processing section -->
                <div id="processingPayment" class="flex flex-col items-center justify-center w-full h-full my-auto">
                    <h2 class="text-3xl font-semibold mb-2">Processing Payment</h2>

                    <div class="w-48 h-48 flex items-center justify-center mb-5">
                        <i class="fa fa-spinner fa-spin fa-3x text-textColor"></i>
                    </div>

                    <p class="text-center">
                        Please wait while we process your payment. This may take a few
                        seconds.
                    </p>
                </div>

                <!-- Success section -->
                <div id="paymentSuccess" class="hidden flex flex-col items-center justify-center w-full h-full my-auto">
                    <h2 class="text-3xl font-semibold mb-2">Payment Success</h2>

                    <div class="w-48 h-48 bg-[#e2fff3] rounded-full flex items-center justify-center mb-5">
                        <div class="w-24 h-24 bg-[#23A26D] rounded-full flex items-center justify-center text-white">
                            <i class="fa fa-check fa-3x"></i>
                        </div>
                    </div>

                    <p>Payment has been successfully done.</p>
                </div>
            </div>
        </div>

        <!-- QRIS Payment modal pop up (If select qris payment)-->
        <div class="fixed inset-0 bg-black/25 flex items-center justify-center backdrop-blur-md bg-opacity-50 z-50 hidden"
            id="qrisPaymentModal">
            <div class="bg-white w-auto h-auto rounded-2xl shadow-lg p-6 flex flex-col items-center">
                <h2 class="text-2xl font-bold text-primary mb-4">QRIS Payment</h2>
                <p class="text-sm text-gray-600 mb-6">
                    Scan the QR code below to complete your payment.
                </p>

                <img src="assets/src/assets/qrcode.png" alt="QRIS Code" class="w-60 h-w-60 mb-4" />

                <h2 class="my-4 text-xl text-textColor">Total : Rp.50.000</h2>

                <button class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark transition"
                    onclick="closeModal('qrisPaymentModal')">
                    Close
                </button>
            </div>
        </div>

        <!-- Modal Update Membership -->
        <div class="fixed inset-0 bg-black/25 backdrop-blur-md justify-center items-center z-50 animate-fadeIn hidden"
            id="updateMembershipModal">
            <!-- Modal Box -->
            <input type="hidden" name="name" id="formUpdateName">
            <input type="hidden" name="phone" id="formUpdatePhone">
            <div
                class="bg-white w-[400px] h-[350px] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-2xl shadow-lg p-6 flex flex-col justify-between">
                <!-- Title -->
                <div>
                    <h2 class="text-center text-2xl font-bold text-primary mb-3">
                        Update Membership
                    </h2>

                    <!-- Status -->
                    <div class="flex items-center justify-center gap-x-4 mb-6">
                        <span class="text-xs font-semibold text-white bg-primary px-3 py-1 rounded">
                            EXPIRED
                        </span>
                        <span class="text-lg">→</span>
                        <span class="text-xs font-semibold text-white bg-blue-500 px-3 py-1 rounded">
                            ACTIVE
                        </span>
                    </div>

                    <!-- Info -->
                    <div class="space-y-4 text-sm text-gray-800">
                        <div class="flex justify-between border-b pb-1">
                            <span>Member</span>
                            <span class="font-semibold" id="lastTypeDisplay">Silver</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Cost Update Member</span>
                            <span class="font-bold text-gray-900">Rp20.000</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6">
                    <button onclick="closeModal('updateMembershipModal')" type="button"
                        class="border border-primary text-primary px-4 py-1 rounded hover:bg-primary hover:text-white transition">
                        Cancel
                    </button>
                    <button type="submit" onclick="updateMembership()"
                        class="bg-linear-[180deg,_#FF5733,_#BB482F] text-white px-4 py-1 rounded hover:opacity-90 transition">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/src/js/order.js"></script>
</body>

</html>