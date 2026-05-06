@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
        <div class="flex items-center">
            <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 px-4 py-3">
            <x-heroicon-o-x-mark class="w-5 h-5" />
        </button>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
        <div class="flex items-center">
            <x-heroicon-o-x-circle class="w-5 h-5 mr-2" />
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 px-4 py-3">
            <x-heroicon-o-x-mark class="w-5 h-5" />
        </button>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
        <div class="flex items-start">
            <x-heroicon-o-exclamation-circle class="w-5 h-5 mr-2 mt-0.5" />
            <div>
                <p class="font-medium mb-1">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 px-4 py-3">
            <x-heroicon-o-x-mark class="w-5 h-5" />
        </button>
    </div>
@endif
