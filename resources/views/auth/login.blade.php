<x-guest-layout>
    <x-slot name="title">Login</x-slot>

    <div class="px-2">
        <div class="mb-10 text-center">
            <h2 class="mb-3 text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">
                Welcome back
            </h2>
            <p class="text-lg font-medium text-slate-500">
                Please enter your details to sign in
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <x-input 
                label="Email Address" 
                name="email" 
                type="email" 
                placeholder="name@company.com" 
                required 
            />

            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-semibold text-slate-700">Password</label>
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors">Forgot password?</a>
                </div>
                <x-input 
                    name="password" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />
            </div>

            <div class="flex items-center">
                <label class="relative flex cursor-pointer select-none items-center group">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="peer sr-only"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <div class="h-6 w-6 rounded-lg border-2 border-slate-200 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary group-hover:border-primary/50">
                        <svg class="h-5 w-5 text-white opacity-0 transition-opacity duration-200 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">Remember for 30 days</span>
                </label>
            </div>

            <div class="pt-2">
                <x-button class="w-full text-lg py-4 cursor-pointer">
                    Sign In
                </x-button>
            </div>

            <div class="text-center">
                <p class="text-sm font-semibold text-slate-500">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark transition-all underline decoration-primary/30 underline-offset-4 hover:decoration-primary">Create an account</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
