<x-guest-layout>
    <x-slot name="title">Register</x-slot>

    <div class="px-2">
        <div class="mb-10 text-center">
            <h2 class="mb-3 text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">
                Create account
            </h2>
            <p class="text-lg font-medium text-slate-500">
                Join our community and manage waste better
            </p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            <x-input 
                label="Full Name" 
                name="name" 
                placeholder="John Doe" 
                required 
            />

            <x-input 
                label="Email Address" 
                name="email" 
                type="email" 
                placeholder="john@example.com" 
                required 
            />

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <x-input 
                    label="Password" 
                    name="password" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />

                <x-input 
                    label="Confirm Password" 
                    name="password_confirmation" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />
            </div>

            <div class="rounded-2xl bg-slate-50 p-6 space-y-4">
                <p class="text-sm font-bold text-slate-900 uppercase tracking-widest">Resident Details</p>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <x-input 
                        label="Wing" 
                        name="wing" 
                        placeholder="A / B / C" 
                    />
                    <x-input 
                        label="Floor" 
                        name="floor" 
                        placeholder="1 / 2 / 3" 
                    />
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-slate-700">Account Type</label>
                <div class="relative group">
                    <select name="role" class="w-full appearance-none rounded-xl border border-slate-300 bg-slate-50/50 px-5 py-3.5 text-slate-700 outline-none transition-all duration-200 focus:border-primary/50 focus:bg-white focus:ring-4 focus:ring-primary/10" required>
                        <option value="resident">Resident</option>
                        <option value="staff">Cleaning Staff</option>
                        <option value="secretary">Secretary</option>
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-primary transition-colors">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
                @error('role')
                    <span class="mt-1 text-sm text-red-700 font-bold italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-2">
                <x-button class="w-full text-lg py-4 cursor-pointer">
                    Create Account
                </x-button>
            </div>

            <div class="text-center">
                <p class="text-sm font-semibold text-slate-500">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark transition-all underline decoration-primary/30 underline-offset-4 hover:decoration-primary">Sign in instead</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
