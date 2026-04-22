<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">File a New Complaint</h1>
            <p class="text-slate-500 mt-2 text-lg">Help us maintain a clean environment by reporting waste collection issues.</p>
        </div>

        <div class="glass-card shadow-premium-xl animate-in fade-in slide-in-from-bottom-4 duration-500">
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 gap-8">
                    <!-- Photo Upload -->
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Proof Photo <span class="text-red-500 font-black">*</span></label>
                        <div class="relative group">
                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*" onchange="previewImage(event)" required>
                            <label for="photo" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-slate-200 rounded-[2rem] bg-slate-50 hover:bg-white hover:border-primary/50 transition-all cursor-pointer group-hover:shadow-glow">
                                <div id="preview-placeholder" class="flex flex-col items-center justify-center py-6">
                                    <div class="h-16 w-16 bg-primary/10 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <p class="text-slate-600 font-bold">Click to upload photo evidence</p>
                                    <p class="text-slate-400 text-xs mt-1 uppercase tracking-tight">PNG, JPG, JPEG up to 2MB</p>
                                </div>
                                <img id="image-preview" class="hidden w-full h-full object-cover rounded-[2rem]">
                            </label>
                        </div>
                        @error('photo')
                            <p class="text-red-700 text-sm font-bold italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Area Selection -->
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Problem Area <span class="text-red-500 font-black">*</span></label>
                        <div class="relative">
                            <select name="area" class="w-full rounded-2xl border border-slate-100 bg-slate-50 px-6 py-4 text-slate-700 font-medium focus:border-primary/50 focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all outline-none appearance-none" required>
                                <option value="" disabled selected>Where is the issue located?</option>
                                <option value="Lobby">Main Lobby</option>
                                <option value="Corridor">Corridor / Hallway</option>
                                <option value="Parking">Parking Area</option>
                                <option value="Gym">Fitness Center / Gym</option>
                                <option value="Elevator">Elevator Area</option>
                                <option value="Garden">Garden / Park Area</option>
                                <option value="Basement">Basement</option>
                                <option value="Basement">Terrace</option>
                                <option value="Other">Other Area</option>
                            </select>
                            <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                        @error('area')
                            <p class="text-red-700 text-sm font-bold italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Area -->
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Issue Description <span class="text-red-500 font-black">*</span></label>
                        <textarea 
                            name="description" 
                            rows="4" 
                            class="w-full rounded-2xl border border-slate-100 bg-slate-50 px-6 py-4 text-slate-700 font-medium placeholder:text-slate-300 focus:border-primary/50 focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all outline-none resize-none"
                            placeholder="Provide details about the waste issue..."
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-700 text-sm font-bold italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resident Context Info (Read Only) -->
                    <div class="flex items-center gap-4 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                        <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="text-xs">
                            <p class="text-slate-500 font-bold uppercase tracking-wider">Reporting For</p>
                            <p class="text-slate-700 font-black">Wing: {{ Auth::user()->wing }} • Floor: {{ Auth::user()->floor }}</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex gap-4">
                        <x-button type="submit" variant="primary" class="flex-1 py-5 shadow-glow text-lg">
                            Submit Complaint
                        </x-button>
                        <a href="{{ route('dashboard') }}" class="flex-1">
                            <x-button type="button" variant="outline" class="w-full py-5 text-lg">
                                Cancel
                            </x-button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('preview-placeholder');
                preview.src = reader.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
