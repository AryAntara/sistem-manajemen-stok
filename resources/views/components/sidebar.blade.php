<div class="w-[500px] h-screen bg-[#368D5B] backdrop-blur-xl">
    <div class="flex flex-col items-center">
        <a class="w-max mt-20" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-20 h-20 rounded-full">
        </a>
        <a class="mt-10 mb-4" href="{{ route('dashboard') }}">
            <div class="p-2 shadow-lg {{ $slot == 'dashboard' ? 'bg-orange-300' : 'bg-[#ffffff]' }}  w-[200px] rounded-3xl hover:bg-orange-300 text-left align-center">
				<i class="mx-2 bi bi-house-fill"></i>
                <span class="text-gray-900 font-bold text-black">Dashboard</span>
            </div>
        </a>

		<hr class="my-2 border-t-1 w-[200px]"></hr>

        <a class="mt-4" href="{{ route('product') }}">
            <div class="p-2 shadow-lg {{ $slot == 'product' ? 'bg-orange-300' : 'bg-[#ffffff]' }} w-[200px] rounded-3xl hover:bg-orange-300 text-left align-center">
				<i class="mx-2 bi bi-box2-fill"></i>
                <span class="text-gray-900 font-bold text-black">Produk</span>
            </div>
        </a>

        <a class="mt-4" href="{{ route('stock') }}">
            <div class="p-2 shadow-lg {{ $slot == 'stock' ? 'bg-orange-300' : 'bg-[#ffffff]' }} w-[200px] rounded-3xl hover:bg-orange-300 text-left align-center">
				<i class="mx-2 bi bi-box-fill"></i>
                <span class="text-gray-900 font-bold text-black">Stok</span>
            </div>
        </a>

		<a class="mt-4" href="{{ route('staff') }}">
            <div class="p-2 shadow-lg {{ $slot == 'staff' ? 'bg-orange-300' : 'bg-[#ffffff]' }} w-[200px] rounded-3xl hover:bg-orange-300 text-left align-center">
				<i class="mx-2 bi bi-people-fill"></i>
                <span class="text-gray-900 font-bold text-black">Karyawan</span>
            </div>
        </a>

        <a class="mt-4 mb-4" href="{{ route('roleStaff') }}">
            <div class="p-2 shadow-lg {{ $slot == 'role_staff' ? 'bg-orange-300' : 'bg-[#ffffff]' }} w-[200px] rounded-3xl hover:bg-orange-300 text-left align-center">
				<i class="mx-2 bi bi-briefcase-fill"></i>
                <span class="text-gray-900 font-bold text-black">Jabatan</span>
            </div>
        </a>

        <hr class="my-2 border-t-1 w-[200px]"></hr>

        <a class="mt-4" href="{{ route('auth.logout') }}">
            <div class="p-2 shadow-lg bg-red-500 w-[200px] rounded-3xl text-left align-center">
				<i class="mx-2 bi bi-arrow-left-square-fill"></i>
                <span class="font-bold">Logout</span>
            </div>
        </a>

    </div>
</div>
