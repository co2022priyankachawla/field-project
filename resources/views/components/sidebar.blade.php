<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-sidebar duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false"
>
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{ route('dashboard') }}">
            <h2 class="text-2xl font-bold text-slate-900 uppercase tracking-widest">
                Waste<span class="text-primary italic">Tracker</span>
            </h2>
        </a>

        <button
            class="block lg:hidden text-slate-500 hover:text-primary"
            @click.stop="sidebarToggle = !sidebarToggle"
        >
            <svg
                class="fill-current"
                width="20"
                height="18"
                viewBox="0 0 20 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill=""
                />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-xs font-bold text-slate-400 uppercase tracking-widest">MENU</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Dashboard (All Roles) -->
                    <li>
                        <a
                            class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                            href="{{ route('dashboard') }}"
                            :class="page === 'dashboard' && 'bg-slate-100 text-primary shadow-sm'"
                        >
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.1437 1.40625H1.85625C1.125 1.40625 0.5625 1.96875 0.5625 2.67188V15.3281C0.5625 16.0312 1.125 16.5938 1.85625 16.5938H16.1437C16.8438 16.5938 17.4375 16.0312 17.4375 15.3281V2.67188C17.4375 1.96875 16.8438 1.40625 16.1437 1.40625ZM1.94062 2.75625H16.0594C16.1156 2.75625 16.1719 2.8125 16.1719 2.86875V7.48125H1.85625V2.86875C1.82812 2.8125 1.88437 2.75625 1.94062 2.75625ZM16.0594 15.2437H1.94062C1.88437 15.2437 1.82812 15.1875 1.82812 15.1312V8.71875H16.1719V15.1312C16.1719 15.1875 16.1156 15.2437 16.0594 15.2437Z" fill=""/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    
                    @if(Auth::user()->isResident())
                        <!-- Resident: File a Complaint -->
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                                href="{{ route('complaints.create') }}"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                File a Complaint
                            </a>
                        </li>
                        <!-- Resident: My Complaints -->
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                                href="{{ route('dashboard') }}"
                            >
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.9688 1.74375H7.03125C6.46875 1.74375 6.01875 2.19375 6.01875 2.75625V3.34687H2.8125C2.25 3.34687 1.8 3.79687 1.8 4.35938V15.2437C1.8 15.8062 2.25 16.2562 2.8125 16.2562H15.1875C15.75 16.2562 16.2 15.8062 16.2 15.2437V4.35938C16.2 3.79687 15.75 3.34687 15.1875 3.34687H11.9812V2.75625C11.9812 2.19375 11.5312 1.74375 10.9688 1.74375ZM10.7437 3.31875H7.25625V3.0375H10.7156V3.31875H10.7437ZM15.1594 4.58437V15.0187H2.84062V4.58437H15.1594Z" fill=""/>
                                </svg>
                                My Complaints
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->isSecretary())
                        <!-- Secretary: Manage Complaints -->
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                                href="{{ route('dashboard') }}#manage-complaints"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                Manage Complaints
                            </a>
                        </li>
                        <!-- Secretary: Complaints History -->
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                                href="{{ route('dashboard') }}#manage-complaints"
                            >
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1.5C4.8 1.5 1.5 4.8 1.5 9C1.5 13.2 4.8 16.5 9 16.5C13.2 16.5 16.5 13.2 16.5 9C16.5 4.8 13.2 1.5 9 1.5ZM9 15C5.7 15 3 12.3 3 9C3 5.7 5.7 3 9 3C12.3 3 15 5.7 15 9C15 12.3 12.3 15 9 15Z" fill=""/>
                                    <path d="M9.75 5.25H8.25V9.75H12.75V8.25H9.75V5.25Z" fill=""/>
                                </svg>
                                Complaints History
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->isStaff())
                        <!-- Staff: Assigned Complaints -->
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                                href="{{ route('dashboard') }}"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Assigned Complaints
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Profile Group -->
            <div>
                <h3 class="mb-4 ml-4 text-xs font-bold text-slate-400 uppercase tracking-widest">SUPPORT</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <li>
                        <a
                            class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2.5 font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-primary"
                            href="#"
                        >
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.5C4.85625 16.5 1.5 13.1437 1.5 9C1.5 4.85625 4.85625 1.5 9 1.5C13.1437 1.5 16.5 4.85625 16.5 9C16.5 13.1437 13.1437 16.5 9 16.5ZM9 3C5.68125 3 3 5.68125 3 9C3 12.3187 5.68125 15 9 15C12.3187 15 15 12.3187 15 9C15 5.68125 12.3187 3 9 3Z" fill=""/>
                                <path d="M9.73125 11.25H8.26875C8.18437 11.25 8.12812 11.1656 8.12812 11.1094V10.2937C8.12812 9.45 8.63437 8.71875 9.42188 8.325C10.0406 8.01562 10.4344 7.39687 10.4344 6.72188C10.4344 5.93438 9.7875 5.2875 9 5.2875C8.2125 5.2875 7.56562 5.93438 7.56562 6.72188C7.56562 6.80625 7.48125 6.89062 7.39687 6.89062H5.90625C5.82187 6.89062 5.7375 6.80625 5.7375 6.72188C5.7375 4.92188 7.2 3.45937 9 3.45937C10.8 3.45937 12.2625 4.92188 12.2625 6.72188C12.2625 8.01562 11.4187 9.14062 10.1812 9.61875C9.75937 9.7875 9.47812 10.2094 9.47812 10.6594V11.1375C9.47812 11.1938 9.42188 11.25 9.3375 11.25H9.73125ZM9 12.7969C8.55 12.7969 8.18437 13.1625 8.18437 13.6125C8.18437 14.0625 8.55 14.4281 9 14.4281C9.45 14.4281 9.81562 14.0625 9.81562 13.6125C9.81562 13.1625 9.45 12.7969 9 12.7969Z" fill=""/>
                            </svg>
                            Help & Support
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
