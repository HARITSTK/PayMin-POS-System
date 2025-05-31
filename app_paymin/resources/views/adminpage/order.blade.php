<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/FEproject/src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/FEproject/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/FEproject/src/components/order.css" />

    <!-- Google Icons -->

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
  </head>
  <body>
    <main
      class="flex items-center justify-between h-screen bg-[#E6EEFD] overflow-hidden font-poppins"
    >
      <nav
        id="navbar"
        class="bg-white h-full overflow-hidden w-[7.2rem] min-w-[7.2rem] p-5 shadow-4xl rounded-r-4xl"
      >
        <div class="flex items-center justify-center mb-2">
          <img
            src="/assets/logoMin.png"
            alt="Logo"
            class="w-20 h-w-20 rounded-full"
          />
        </div>
        <ul id="navbar-list" class="flex flex-col h-full w-full relative z-10">
          <!-- Daftar item navigasi utama -->
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/home.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-home fa-2x"></i>

              <p class="text-sm">Home</p>
            </a>
          </li>
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/order.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-cart-plus fa-2x"></i>
              <p class="text-sm">Orders</p>
            </a>
          </li>
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/report.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-file-text-o fa-2x"></i>
              <p class="text-sm">Report</p>
            </a>
          </li>
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/items.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-th fa-2x"></i>
              <p class="text-sm">Items</p>
            </a>
          </li>
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/master.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-key fa-2x"></i>
              <p class="text-sm">Master</p>
            </a>
          </li>
          <li
            class="flex flex-col items-center justify-center text-[#8B8B8B] hover:text-primary transition-all duration-300 ease-in-out h-[70px] relative z-20 cursor-pointer"
          >
            <a
              href="/src/pages/settings.html"
              class="flex flex-col items-center justify-center"
              onclick="route()"
            >
              <i class="fa fa-cog fa-2x"></i>
              <p class="text-sm">Settings</p>
            </a>
          </li>
          <span class="highlight-span mx-auto shadow-2xl"></span>
          <li
            class="flex flex-col items-center justify-center mt-[4em] text-[#8B8B8B] hover:text-red-400 cursor-pointer"
          >
            <i class="fa fa-sign-out fa-2x"></i>
            <p class="text-sm">Logout</p>
          </li>
        </ul>
      </nav>
      <!-- Main Content -->
      <section class="h-full w-full p-11 box-border overflow-y-auto">
        <div
          class="mb-8 w-full shadow-4xl rounded-xl bg-linear-[90deg,_#FFFFFF,_#E6EEFD] p-7"
        >
          <h1 class="text-[22pt] font-bold text-[#353535]">
            Pay<span class="text-primary">Min</span> CoffeShop
          </h1>
          <p class="text-textColor text-lg">Saturday, 3 Mei 2025</p>
        </div>

        <div
          class="flex justify-between w-full shadow-4xl rounded-xl bg-white px-5 py-2"
        >
          <ul class="flex flex-row items-center gap-3">
            <li
              class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]"
            >
              <button
                type="button"
                class="w-full h-full focus:outline-none cursor-pointer"
              >
                All
              </button>
            </li>
            <li
              class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]"
            >
              <button
                type="button"
                class="w-full h-full focus:outline-none cursor-pointer"
              >
                Cake
              </button>
            </li>
            <li
              class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]"
            >
              <button
                type="button"
                class="w-full h-full focus:outline-none cursor-pointer"
              >
                Drink
              </button>
            </li>
            <li
              class="border-2 border-gray-400 rounded-3xl px-5 hover:text-primary hover:border-primary cursor-pointer hover:bg-[#FFB09F]"
            >
              <button
                type="button"
                class="w-full h-full focus:outline-none cursor-pointer"
              >
                Food
              </button>
            </li>
          </ul>

          <form class="flex items-center gap-2">
            <div class="relative w-full">
              <span
                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"
              >
                <i class="fa fa-search"></i>
              </span>
              <input
                type="text"
                placeholder="Search food, coffe, etc..."
                class="border border-gray-300 rounded-2xl pl-10 pr-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary"
              />
            </div>
          </form>
        </div>

        <div
          class="grid grid-cols-4 auto-rows-auto gap-4 justify-items-center p-4"
          id="orderList"
        >
          <!-- Item Card Template (Repeated) -->
          <div
            class="flex flex-col items-center justify-center bg-white shadow-4xl rounded-xl cursor-pointer hover:bg-gray-100 transition-all duration-200 p-6 w-full h-[50vh] relative mt-10"
          >
            <div class="relative w-full h-full">
              <img
                src="assets/coffee.png"
                alt="Product"
                class="rounded-full mb-3 absolute -top-20 left-1/2 transform -translate-x-1/2"
              />
            </div>
            <h2 class="text-2xl font-semibold">Coffee</h2>
            <div class="flex justify-between w-full mt-4">
              <p class="text-tertiary">Stock</p>
              <p class="text-textColor font-bold">10</p>
            </div>
            <div class="flex justify-between w-full mt-2">
              <p class="text-tertiary">Price</p>
              <p class="text-primary font-bold">Rp. 14.000</p>
            </div>
            <button
              class="bg-linear-[180deg,_#FF5733,_#BB482F] w-full py-2 mt-5 rounded-lg text-white font-semibold toggleSidebarBtn"
              onclick="toggleSidebar('sidebarOrderedList')"
            >
              Add
            </button>
          </div>
        </div>
      </section>

      <!-- Modal Order Confirmation -->
      <div
        class="fixed hidden inset-0 flex items-center justify-center backdrop-blur-md bg-opacity-50 bg-opacity-50 z-100 w-full animate-fadeIn"
        id="modalOrder"
      >
        <div
          class="bg-white relative rounded-2xl p-6 w-[50vw] h-auto shadow-lg modal-content"
        >
          <h2 class="text-3xl font-semibold text-center mb-2">
            Order confirmation
          </h2>
          <p class="text-sm text-gray-500 text-center mb-4">
            Please confirm the order
          </p>

          <div class="flex justify-between text-sm mb-4">
            <span>#Orders0021</span>
            <span>23/05/2025 | 14:30</span>
          </div>

          <div class="overflow-y-auto h-[10em] mb-4">
            <table class="table-fixed w-full">
              <thead class="border-b-2 border-tertiary h-[3rem]">
                <tr>
                  <th class="text-left">ITEM NAME</th>
                  <th class="text-left">QTY</th>
                  <th class="text-left">TAX</th>
                  <th class="text-left">SUB TOTAL</th>
                </tr>
              </thead>
              <tbody class="">
                <tr class="border-b border-tertiary h-[3rem]">
                  <td>Steak Sapi bakar</td>
                  <td>2</td>
                  <td>Rp1.500</td>
                  <td>Rp40.000</td>
                </tr>
                <tr class="border-b border-tertiary h-[3rem]">
                  <td>Steak Sapi bakar</td>
                  <td>2</td>
                  <td>Rp1.500</td>
                  <td>Rp40.000</td>
                </tr>
                <tr class="border-b border-tertiary h-[3rem]">
                  <td>Steak Sapi bakar</td>
                  <td>2</td>
                  <td>Rp1.500</td>
                  <td>Rp40.000</td>
                </tr>
                <tr class="border-b border-tertiary h-[3rem]">
                  <td>Steak Sapi bakar</td>
                  <td>2</td>
                  <td>Rp1.500</td>
                  <td>Rp40.000</td>
                </tr>
                <tr class="border-b border-tertiary h-[3rem]">
                  <td>Steak Sapi bakar</td>
                  <td>2</td>
                  <td>Rp1.500</td>
                  <td>Rp40.000</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="bottom-0 left-0 w-full h-auto">
            <div class="flex justify-between">
              <div class="bg-gray-100 p-4 rounded-lg mb-4 text-sm w-[50%]">
                <h1 class="font-bold text-lg">Notes</h1>
                <p>
                  Lorem ipsum has been the industry's standard dummy text ever
                  since the 1500s...
                </p>
              </div>
              <table class="w-[50%] text-sm mb-4 text-right">
                <tbody>
                  <tr>
                    <td class="py-1 text-tertiary">SUBTOTAL</td>
                    <td class="py-1 text-right">Rp70.000</td>
                  </tr>
                  <tr>
                    <td class="py-1 text-tertiary">ORDER DISCOUNT</td>
                    <td class="py-1 text-right">Rp0</td>
                  </tr>
                  <tr>
                    <td class="py-1 text-tertiary">TAX</td>
                    <td class="py-1 text-right">Rp1.500</td>
                  </tr>
                  <tr class="font-bold">
                    <td class="py-1">BILL AMOUNT</td>
                    <td class="py-1 text-right text-primary">Rp71.500</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex justify-between">
              <div>
                <h1 class="text-sm font-light text-tertiary">
                  Payment method:
                </h1>
                <div class="flex">
                  <img
                    src="assets/paymentIcons/cash.png"
                    alt="Cash"
                    class="w-5 h-5 mr-2"
                  />
                  Cash
                </div>
              </div>
              <div>
                <button
                  class="border-2 border-primary px-4 py-2 rounded-lg text-primary"
                  onclick="closeModal('modalOrder')"
                >
                  Cancel
                </button>
                <button
                  class="bg-linear-[180deg,_#FF5733,_#BB482F] px-4 py-2 rounded-lg text-white"
                >
                  Confirm
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Payment Process/Success -->
      <div
        class="fixed inset-0 flex items-center justify-center backdrop-blur-md bg-opacity-50 bg-opacity-50 z-100 w-full animate-fadeIn hidden"
        id="modalOrder"
      >
        <div
          class="bg-white relative rounded-2xl p-16 w-[50vw] h-[80vh] shadow-lg modal-content flex flex-col items-center"
        >
          <h2 class="text-3xl font-semibold text-center mb-2">
            Processing Payment
          </h2>

          <div
            class="flex flex-col items-center justify-center w-full h-full my-auto"
          >
            <div
              class="w-48 h-48 bg-[#e2fff3] rounded-full flex items-center justify-center mb-5"
            >
              <div
                class="text-white w-24 h-24 bg-[#23A26D] rounded-full flex items-center justify-center"
              >
                <i class="fa fa-check fa-3x" aria-hidden="true"></i>
              </div>
            </div>

            <h1 class="text-2xl font-medium">Payment Success</h1>
            <p class="">Payment has been successfully done.</p>
          </div>
        </div>
      </div>

      <!-- Sidebar Ordered List -->
      <aside
        id="sidebarOrderedList"
        class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden"
      >
        <div class="flex items-center justify-between w-full px-6 py-5">
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              1
            </div>
            <p class="text-textColor text-sm">Orders</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              2
            </div>
            <p class="text-textColor text-sm">Payment</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              3
            </div>
            <p class="text-textColor text-sm">Finish</p>
          </span>
        </div>
        <div
          class="flex items-center justify-between gap-4 my-2 w-full py-2 px-6"
        >
          <div
            class="flex justify-center font-light items-center gap-x-2 border-2 border-[#8B8B8B] rounded-xl px-4 py-2 text-[#8B8B8B] has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
          >
            <form action="/action_page.php" class="flex items-center gap-2">
              <i class="fa fa-cutlery" aria-hidden="true"></i>
              <label for="dinein">Dine In</label>
              <input
                type="checkbox"
                id="dinein"
                name="dinein"
                value="DineIn"
                class="appearance-none w-4 h-4 rounded-full border-2 border-[#8B8B8B] checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
              />
            </form>
          </div>
          <div
            class="flex font-light justify-center items-center gap-x-2 border-2 border-[#8B8B8B] rounded-xl px-4 py-2 text-[#8B8B8B] has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
          >
            <form action="/action_page.php" class="flex items-center gap-2">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <label for="togo">To Go</label>
              <input
                type="checkbox"
                id="togo"
                name="togo"
                value="ToGo"
                class="appearance-none w-4 h-4 rounded-full border-2 border-[#8B8B8B] checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
              />
            </form>
          </div>
        </div>
        <div class="w-full px-6">
          <p class="text-textColor text-sm">#Orders0021 | 23/05/2025 | 14:30</p>
          <hr class="w-full h-[1px] my-2 border-0 bg-tertiary" />
        </div>

        <!-- Orders -->
        <div
          id="orderedList"
          class="h-full w-full flex flex-col items-center mt-2 overflow-y-auto px-6"
        >
          <div class="flex flex-col items-center w-full mt-2">
            <div class="flex justify-between w-full h-[60px]">
              <div class="flex items-center justify-center w-[5em]">
                <img
                  src="assets/coffee.png"
                  alt="Coffee"
                  class="w-full object-cover h-full"
                />
              </div>
              <div class="w-auto">
                <h1
                  class="text-textColor text-lg font-semibold overflow-hidden text-ellipsis whitespace-nowrap w-[70%]"
                >
                  Coffe Capuchino
                </h1>
                <p class="text-textColor text-sm w-auto">Rp. 20.000</p>
              </div>
              <div class="w-auto">
                <h1 class="text-primary text-2xl font-bold">40k</h1>
              </div>
            </div>
            <div class="flex items-center justify-end gap-1 w-full">
              <button
                class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold focus:outline-none"
                onclick="decrementCounter()"
                type="button"
              >
                -
              </button>
              <span
                id="itemCounter"
                class="text-lg font-semibold w-8 text-center"
                >1</span
              >
              <button
                class="bg-primary text-white rounded-md w-8 h-8 flex items-center justify-center text-xl font-bold focus:outline-none"
                onclick="incrementCounter()"
                type="button"
              >
                +
              </button>
            </div>
            <div class="flex justify-between items-center w-full h-12 mt-2">
              <button
                class="bg-[#C9C9C9] text-white h-full rounded-md text-sm font-medium flex items-center w-[75%] justify-center"
                type="button"
              >
                Please Low Sugar
              </button>
              <button
                class="text-tertiary hover:text-red-700 h-full rounded-md border-2 border-tertiary transition-colors duration-200 w-[20%]"
                type="button"
                aria-label="Remove item"
              >
                <i class="fa fa-trash fa-lg"></i>
              </button>
            </div>
            <hr class="w-full h-[1px] my-6 border-0 bg-tertiary" />
          </div>
        </div>

        <div
          class="h-[25%] w-full flex flex-col justify-end bottom-0 p-6 shadow-continuePayment bg-white"
        >
          <div class="flex justify-between items-center">
            <h1 class="text-tertiary text-lg font-light">Pajak</h1>
            <p class="text-textColor text-sm w-auto">Rp. 20.000</p>
          </div>
          <div class="flex justify-between items-center">
            <h1 class="text-tertiary text-lg font-light">Subtotal</h1>
            <p class="text-textColor text-lg font-bold w-auto">Rp. 20.000</p>
          </div>
          <div class="flex justify-end mt-3 w-full">
            <button
              class="bg-linear-[180deg,_#FF5733,_#BB482F] orderNextButton-content text-white px-8 py-[0.80rem] rounded-lg text-lg font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 w-full"
              type="button"
              onclick="orderNext()"
            >
              Continue Payment
            </button>
          </div>
        </div>
      </aside>

      <!-- Sidebar Payment -->
      <aside
        id="sidebarPayment"
        class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden"
      >
        <!-- Order Process -->
        <div class="flex items-center justify-between w-full px-6 py-5">
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              1
            </div>
            <p class="text-textColor text-sm">Orders</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              2
            </div>
            <p class="text-textColor text-sm">Payment</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="border-tertiary border-2 text-tertiary w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              3
            </div>
            <p class="text-textColor text-sm">Finish</p>
          </span>
        </div>

        <h2 class="text-lg text-left w-full font-semibold text-textColor px-6">
          Payment Method
        </h2>
        <!-- Select Payment -->
        <div
          class="w-full px-6 h-full relative overflow-y-auto"
          id="paymentMethod"
        >
          <!-- Select Payment -->
          <div class="flex flex-col p-3 gap-4 w-full h-auto">
            <div class="space-y-2">
              <h3 class="text-lg font-medium text-textColor">E-Wallet</h3>
              <div class="flex flex-col gap-1">
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/logoShopeePay-01.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="ShopeePay">ShopeePay</label>
                    </div>

                    <input
                      type="checkbox"
                      id="ShopeePay"
                      name="ShopeePay"
                      value="ShopeePay"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/qris.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="Qris">Qris</label>
                    </div>

                    <input
                      type="checkbox"
                      id="Qris"
                      name="Qris"
                      value="Qris"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/dana.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="Dana">Dana</label>
                    </div>

                    <input
                      type="checkbox"
                      id="Dana"
                      name="Dana"
                      value="Dana"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <h3 class="text-lg font-medium text-textColor">Card</h3>
              <div class="flex flex-col gap-1">
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/muamalat.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="Muamalat">Muamalat</label>
                    </div>

                    <input
                      type="checkbox"
                      id="Muamalat"
                      name="Muamalat"
                      value="Muamalat"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/bri.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="BRI">BRI</label>
                    </div>

                    <input
                      type="checkbox"
                      id="BRI"
                      name="BRI"
                      value="BRI"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/bca.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="BCA">BCA</label>
                    </div>

                    <input
                      type="checkbox"
                      id="BCA"
                      name="BCA"
                      value="BCA"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <h3 class="text-lg font-medium text-textColor">Other</h3>
              <div class="flex flex-col gap-1">
                <div
                  class="flex justify-center font-light items-center gap-x-2 border-2 border-tertiary rounded-lg px-4 py-2 bg-none text-tertiary has-checked:border-primary has-checked:bg-[#fff6f4] has-checked:text-primary"
                >
                  <form
                    action="/action_page.php"
                    class="flex items-center justify-between w-full px-2"
                  >
                    <div class="flex items-center justify-center gap-x-2">
                      <div class="w-6 h-6">
                        <img
                          src="assets/paymentIcons/cash.png"
                          alt="ShopeePay"
                          class="w-full object-contain"
                        />
                      </div>
                      <label for="Cash">Cash</label>
                    </div>

                    <input
                      type="checkbox"
                      id="Cash"
                      name="Cash"
                      value="Cash"
                      class="appearance-none w-4 h-4 rounded-full border-2 border-tertiary checked:bg-primary checked:border-primary focus:outline-none transition-colors duration-200"
                    />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pay Orders -->
        <div
          class="relative h-[25%] w-full flex flex-col justify-end bottom-0 p-6 shadow-continuePayment bg-white"
        >
          <div class="flex justify-between items-center">
            <h1 class="text-tertiary text-lg font-light">Pajak</h1>
            <p class="text-textColor text-sm w-auto">Rp. 20.000</p>
          </div>
          <div class="flex justify-between items-center">
            <h1 class="text-tertiary text-lg font-light">Subtotal</h1>
            <p class="text-textColor text-lg font-bold w-auto">Rp. 20.000</p>
          </div>
          <div class="flex justify-between mt-3 w-full">
            <button
              class="border-2 border-primary text-primary rounded-lg text-[11pt] font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 py-2 px-1 w-auto"
              type="button"
              id="continuePaymentBtn"
              onclick="paymentBack()"
            >
              Back to Orders
            </button>
            <button
              class="bg-linear-[180deg,_#FF5733,_#BB482F] text-white rounded-lg text-[11pt] font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 py-2 px-1 w-auto"
              type="button"
              id="continuePaymentBtn"
              onclick="paymentNext()"
            >
              Continue Payment
            </button>
          </div>
        </div>
      </aside>

      <!-- Sidebar Finish -->
      <aside
        id="sidebarFinish"
        class="right-0 top-0 h-full w-[33em] bg-white shadow-lg flex flex-col items-center z-40 transition-all duration-300 ease-in-out relative hidden"
      >
        <div class="flex items-center justify-between w-full px-6 py-5">
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              1
            </div>
            <p class="text-textColor text-sm">Orders</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              2
            </div>
            <p class="text-textColor text-sm">Payment</p>
          </span>
          <span class="flex flex-col font-light items-center">
            <div
              class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full mb-1"
            >
              3
            </div>
            <p class="text-textColor text-sm">Finish</p>
          </span>
        </div>

        <div
          class="w-full px-4 h-full relative overflow-y-auto"
          id="printOrder"
        >
          <div class="flex flex-col gap-4 w-full h-auto">
            <div
              class="bg-white relative rounded-2xl p-6 w-full h-auto shadow-4xl modal-content"
            >
              <h2 class="text-3xl font-semibold text-center mb-2">
                Order confirmation
              </h2>
              <p class="text-sm text-gray-500 text-center mb-4">
                Please confirm the order
              </p>

              <div class="flex justify-between text-sm mb-4">
                <span>#Orders0021</span>
                <span>23/05/2025 | 14:30</span>
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
                  <tbody class="">
                    <tr class="border-b border-tertiary h-[3rem]">
                      <td>Steak Sapi bakar</td>
                      <td>2</td>
                      <td>Rp1.500</td>
                      <td>Rp40.000</td>
                    </tr>
                    <tr class="border-b border-tertiary h-[3rem]">
                      <td>Steak Sapi bakar</td>
                      <td>2</td>
                      <td>Rp1.500</td>
                      <td>Rp40.000</td>
                    </tr>
                    <tr class="border-b border-tertiary h-[3rem]">
                      <td>Steak Sapi bakar</td>
                      <td>2</td>
                      <td>Rp1.500</td>
                      <td>Rp40.000</td>
                    </tr>
                    <tr class="border-b border-tertiary h-[3rem]">
                      <td>Steak Sapi bakar</td>
                      <td>2</td>
                      <td>Rp1.500</td>
                      <td>Rp40.000</td>
                    </tr>
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
                      <img
                        src="/src/assets/paymentIcons/cash.png"
                        alt="Cash"
                        class="w-5 h-5 mr-2"
                      />
                      Cash
                    </div>
                  </div>

                  <table class="w-full mb-4 text-right">
                    <tbody>
                      <tr>
                        <td class="py-1 text-tertiary">SUBTOTAL</td>
                        <td class="py-1 text-right">Rp70.000</td>
                      </tr>
                      <tr>
                        <td class="py-1 text-tertiary">ORDER DISCOUNT</td>
                        <td class="py-1 text-right">Rp0</td>
                      </tr>
                      <tr>
                        <td class="py-1 text-tertiary">TAX</td>
                        <td class="py-1 text-right">Rp1.500</td>
                      </tr>
                      <tr class="font-bold">
                        <td class="py-1">BILL AMOUNT</td>
                        <td class="py-1 text-right text-primary">Rp71.500</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pay Orders -->
        <div
          class="relative h-auto w-full flex flex-col justify-end bottom-0 p-6"
        >
          <div class="flex justify-end mt-3 w-full">
            <button
              class="bg-linear-[180deg,_#FF5733,_#BB482F] text-white px-8 py-[0.80rem] rounded-lg text-lg font-semibold shadow-md hover:bg-primary-dark transition-colors duration-200 w-full"
              type="button"
              id="continuePaymentBtn"
              onclick="showModal('modalOrder')"
            >
              Continue Payment
            </button>
          </div>
        </div>
      </aside>
    </main>

    <script src="assets/FEproject/src/js/order.js"></script>
  </body>
</html>
