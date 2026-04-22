<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Waste Tracker' }} | Waste Collection Feedback Mechanism</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body
    x-data="{ page: 'dashboard', 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         $watch('sidebarToggle', value => {
            if (value) {
                document.body.classList.add('overflow-hidden');
            } else {
                document.body.classList.remove('overflow-hidden');
            }
         });
    "
    class="bg-main text-body font-sans antialiased"
>

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        <x-sidebar />
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">

            <!-- ===== Header Start ===== -->
            <x-navbar />
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    {{ $slot }}
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    @stack('scripts')
</body>
</html>
