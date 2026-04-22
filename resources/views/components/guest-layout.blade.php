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
</head>
<body class="bg-main text-body font-sans antialiased">
    <div class="relative flex min-h-screen items-center justify-center p-6 sm:p-12 overflow-hidden">
        <!-- Decorative Background Element -->
        <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-primary/5 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-secondary/10 blur-3xl"></div>

        <div class="relative w-full max-w-[550px]">
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center gap-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary shadow-glow">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 uppercase tracking-tight">
                        Waste<span class="text-primary">Tracker</span>
                    </h1>
                </a>
            </div>
            
            <div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-premium-xl sm:p-12">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
