<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>

    <div class="px-2">
        <div class="mb-10 text-center">
            <h2 class="mb-3 text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">
                New Password
            </h2>
            <p class="text-lg font-medium text-slate-500">
                Please enter your new password below.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-4 font-medium text-sm text-red-600 bg-red-50 p-4 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">

            <x-input 
                label="Email Address" 
                name="email" 
                type="email" 
                value="{{ old('email', $email ?? '') }}"
                placeholder="name@company.com" 
                required 
                autofocus
            />

            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700">Password</label>
                <x-input 
                    name="password" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700">Confirm Password</label>
                <x-input 
                    name="password_confirmation" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />
            </div>

            <div class="pt-2">
                <x-button class="w-full text-lg py-4 cursor-pointer">
                    Reset Password
                </x-button>
            </div>
        </form>
    </div>
</x-guest-layout>
