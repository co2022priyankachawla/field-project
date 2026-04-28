<x-guest-layout>
    <x-slot name="title">Forgot Password</x-slot>

    <div class="px-2">
        <div class="mb-10 text-center">
            <h2 class="mb-3 text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">
                Reset Password
            </h2>
            <p class="text-lg font-medium text-slate-500">
                Enter your email address and we will send you a password reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf
            
            <x-input 
                label="Email Address" 
                name="email" 
                type="email" 
                value="{{ old('email') }}"
                placeholder="name@company.com" 
                required 
                autofocus
            />

            <div class="pt-2">
                <x-button class="w-full text-lg py-4 cursor-pointer">
                    Email Password Reset Link
                </x-button>
            </div>

            <div class="text-center">
                <p class="text-sm font-semibold text-slate-500">
                    Remember your password? 
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark transition-all underline decoration-primary/30 underline-offset-4 hover:decoration-primary">Back to login</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
