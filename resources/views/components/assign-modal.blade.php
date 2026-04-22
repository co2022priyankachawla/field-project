<x-modal name="assign-task" title="Assign Cleaning Staff">
    <form action="#" method="POST">
        @csrf
        <div class="mb-4.5">
            <label class="mb-2.5 block text-black dark:text-white">
                Select Cleaning Staff
            </label>
            <div class="relative z-20 bg-transparent dark:bg-form-input">
                <select class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-strokedark dark:bg-form-input">
                    <option value="" class="text-body">Select staff</option>
                    <option value="1" class="text-body">John Doe</option>
                    <option value="2" class="text-body">Jane Smith</option>
                    <option value="3" class="text-body">Mike Ross</option>
                </select>
                <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10H7Z" fill=""/>
                    </svg>
                </span>
            </div>
        </div>

        <div class="flex justify-end gap-4.5">
            <x-button type="button" variant="outline" @click="show = false">
                Cancel
            </x-button>
            <x-button type="submit">
                Assign Task
            </x-button>
        </div>
    </form>
</x-modal>
