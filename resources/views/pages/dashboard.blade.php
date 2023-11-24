@extends("layouts.default")
@section('content')
<div class="flex">
    <!-- Component Sidebar Start -->
    <x-sidebar>
        dashboard
    </x-sidebar>
    <!-- Component End  -->

    <!-- body -->
    <div class="m-16 w-full">
        <div class="h-36">
            <div class="text-[#368D5B] font-bold text-3xl">
                KARYAWAN
            </div>
            <div class="flex justify-between items-center mt-10">
                <div class="bg-[#368D5B] w-max p-1 rounded-full h-max">
                    <i class="bi mx-2 bi-search text-white"></i>
                    <input type="text" class="w-auto bg-[#368D5B] outline-none text-white mx-2 p-1 placeholder-white"
                        placeholder="Cari nama staff...">
                </div>

                <div x-data='{isShowText: false, isShowModalAdd: false}'>
                    <button class="bg-[#368D5B] text-xl rounded-full text-white p-2" x-on:click="isShowModalAdd = !isShowModalAdd">
                        <i class="text-2xl bi bi-plus m-1"></i>
                    </button>

                    @php
                        $id = 1;
                    @endphp
                    <x-karyawan-modal-add>
                        {{ $id }}
                    </x-karyawan-modal-add>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection()