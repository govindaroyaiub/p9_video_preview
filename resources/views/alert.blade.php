@if ($errors->any())
<div x-data="{ show: true }" x-show="show"
    class="flex justify-between items-center bg-red-200 relative text-white-600 py-3 px-3 rounded-lg">
    @foreach ($errors->all() as $error)
    <div>
        <span class="font-semibold text-white-700">{{ $error }}</span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
    @endforeach
</div>
<br>
@endif
@if (session('success'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-green-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('success') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('error'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-teal-200 relative text-teal-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('error') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('warning'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-yellow-200 relative text-yellow-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('warning') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('info'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-blue-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('info') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('create-user'))
<div x-data="{ show: true }" x-show="show"
    class="flex justify-between items-center bg-blue-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('create-user') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('delete-user'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-blue-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('delete-user') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('info-password'))
<div x-data="{ show: true }" x-show="show"
    class="flex justify-between items-center bg-blue-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('info-password') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif
@if (session('danger'))
<div x-data="{ show: true }" x-show="show"
    class="w-2/3 flex justify-between items-center bg-red-200 relative text-white-600 py-3 px-3 rounded-lg">
    <div>
        <span class="font-semibold text-white-700">{{ session('danger') }} </span>
    </div>
    <div>
        <button type="button" @click="show = false" class="text-gray-900">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
</div>
<br>
@endif