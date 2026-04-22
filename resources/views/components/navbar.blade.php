<header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
    <div class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 2xl:px-11">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button
                class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
                @click.stop="sidebarToggle = !sidebarToggle"
            >
                <span class="relative block h-5.5 w-5.5 cursor-pointer">
                    <span class="du-block absolute right-0 h-full w-full">
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                            :class="!sidebarToggle && '!w-full delay-300'"
                        ></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                            :class="!sidebarToggle && '!w-full delay-400'"
                        ></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                            :class="!sidebarToggle && '!w-full delay-500'"
                        ></span>
                    </span>
                    <span class="absolute right-0 h-full w-full rotate-45">
                        <span
                            class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                            :class="!sidebarToggle && '!h-0 !delay-[0]'"
                        ></span>
                        <span
                            class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                            :class="!sidebarToggle && '!h-0 !delay-[0]'"
                        ></span>
                    </span>
                </span>
            </button>
            <!-- Hamburger Toggle BTN -->

        <div class="flex items-center gap-3 2x:gap-7 lg:hidden">
            <a class="block flex-shrink-0" href="{{ route('dashboard') }}">
                <span class="text-xl font-bold text-slate-900 uppercase tracking-tight">Waste<span class="text-primary">Tracker</span></span>
            </a>
        </div>

        <div class="hidden sm:block">
            <form action="#" method="POST">
                <div class="relative">
                    <button class="absolute left-0 top-1/2 -translate-y-1/2">
                        <svg
                            class="fill-slate-400 hover:fill-primary transition-colors"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M9.16666 3.33332C5.945 3.33332 3.33332 5.945 3.33332 9.16666C3.33332 12.3883 5.945 15 9.16666 15C12.3883 15 15 12.3187 15 9.16666C15 5.945 12.3883 3.33332 9.16666 3.33332ZM1.66666 9.16666C1.66666 5.02452 5.02452 1.66666 9.16666 1.66666C13.3088 1.66666 16.6667 5.02452 16.6667 9.16666C16.6667 13.3088 13.3088 16.6667 9.16666 16.6667C5.02452 16.6667 1.66666 13.3088 1.66666 9.16666Z"
                                fill=""
                            />
                        </svg>
                    </button>

                    <input
                        type="text"
                        placeholder="Search for complaints..."
                        class="w-full bg-transparent pl-9 pr-4 font-medium text-slate-600 focus:outline-none xl:w-125"
                    />
                </div>
            </form>
        </div>

        <div class="flex items-center gap-3 2x:gap-7">
            <!-- Notifications -->
            <ul class="flex items-center gap-2 2x:gap-4 border-r border-slate-100 pr-3 mr-3">
                <li class="relative">
                    <a
                        class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-slate-50 border border-slate-100 text-slate-500 hover:text-primary transition-all duration-200"
                        href="#"
                    >
                        <span class="absolute top-2.5 right-2.5 z-1 h-2 w-2 rounded-full bg-red-500"></span>
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1999 14.9344L15.6374 14.0625C15.5249 13.9219 15.4687 13.7531 15.4687 13.5844V7.11563C15.4687 3.57188 12.6562 0.675 9.1687 0.675C5.65308 0.675 2.84058 3.57188 2.84058 7.11563V13.5844C2.84058 13.7531 2.78433 13.9219 2.67183 14.0625L2.10933 14.9344C1.88433 15.2719 2.10933 15.75 2.5312 15.75H15.7781C16.1999 15.75 16.4249 15.2719 16.1999 14.9344Z" fill=""/>
                        </svg>
                    </a>
                </li>
            </ul>

            <!-- Standalone Logout -->
            <form action="{{ route('logout') }}" method="POST" class="mr-3">
                @csrf
                <button type="submit" class="flex items-center gap-2 rounded-xl bg-red-50 px-3 py-2 text-sm font-bold text-red-600 hover:bg-red-100 transition-all duration-200">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.5375 10.3813L12.4438 7.21875C12.1906 6.96562 11.7719 6.96562 11.5188 7.21875C11.2656 7.47188 11.2656 7.89062 11.5188 8.14375L13.6844 10.3531H4.125C3.76875 10.3531 3.5 10.6219 3.5 10.9781C3.5 11.3344 3.76875 11.6031 4.125 11.6031H13.6844L11.5188 13.8125C11.2656 14.0656 11.2656 14.4844 11.5188 14.7375C11.6438 14.8625 11.8062 14.925 11.9688 14.925C12.1312 14.925 12.2938 14.8625 12.4188 14.7375L15.5125 11.575C15.8219 11.2375 15.8219 10.7188 15.5375 10.3813Z" fill=""/>
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>

            <!-- User Area -->
            <div
                class="relative"
                x-data="{ dropdownOpen: false }"
                @click.outside="dropdownOpen = false"
            >
                <a
                    class="flex items-center gap-3"
                    href="#"
                    @click.prevent="dropdownOpen = !dropdownOpen"
                >
                    <span class="hidden text-right lg:block">
                        <span class="block text-sm font-bold text-slate-900">{{ Auth::user()->name ?? 'Guest User' }}</span>
                        <span class="block text-xs font-semibold text-slate-500 tracking-wider uppercase">{{ ucfirst(Auth::user()->role ?? 'Resident') }}</span>
                    </span>

                    <span class="h-12 w-12 rounded-full overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=3C50E0&color=fff" alt="User" />
                    </span>

                    <svg
                        :class="dropdownOpen && 'rotate-180'"
                        class="hidden fill-current sm:block"
                        width="12"
                        height="8"
                        viewBox="0 0 12 8"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08925L6.58928 7.08925C6.26384 7.41469 5.7362 7.41469 5.41077 7.08925L0.410765 2.08925C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                            fill=""
                        />
                    </svg>
                </a>

                <!-- Dropdown Start -->
                <div
                    x-show="dropdownOpen"
                    class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
                >
                    <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7.5 dark:border-strokedark">
                        <li>
                            <a href="#" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 11.55C13.292 11.55 15.15 9.69198 15.15 7.4C15.15 5.10802 13.292 3.25 11 3.25C8.70802 3.25 6.85 5.10802 6.85 7.4C6.85 9.69198 8.70802 11.55 11 11.55Z" fill=""/>
                                </svg>
                                My Profile
                            </a>
                        </li>
                    </ul>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">
                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5375 10.3813L12.4438 7.21875C12.1906 6.96562 11.7719 6.96562 11.5188 7.21875C11.2656 7.47188 11.2656 7.89062 11.5188 8.14375L13.6844 10.3531H4.125C3.76875 10.3531 3.5 10.6219 3.5 10.9781C3.5 11.3344 3.76875 11.6031 4.125 11.6031H13.6844L11.5188 13.8125C11.2656 14.0656 11.2656 14.4844 11.5188 14.7375C11.6438 14.8625 11.8062 14.925 11.9688 14.925C12.1312 14.925 12.2938 14.8625 12.4188 14.7375L15.5125 11.575C15.8219 11.2375 15.8219 10.7188 15.5375 10.3813Z" fill=""/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
                <!-- Dropdown End -->
            </div>
        </div>
    </div>
</header>
