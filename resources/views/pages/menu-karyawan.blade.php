@extends('layouts.default')

@section('content')
    <div class="flex">
        <!-- Component Sidebar Start -->
        <x-sidebar>
            logo
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

                    <button class="bg-[#368D5B] text-xl rounded-full text-white p-2">
                        <i class="text-2xl bi bi-plus m-1"></i>
                    </button>
                </div>
            </div>
            <div class="w-full h-auto mt-8">
                <div class="overflow-x-scroll overflow-y-hidden">
                    <table class="w-full border-collapse">
                        <thead class="text-[#368D5B] border-b font-bold align-left p-32">
                            <tr class="">
                                <th class="py-2" align="left">NAMA</th>
                                <th class="py-2" align="left">NAMA</th>
                                <th class="py-2" align="left">NAMA</th>
                                <th class="py-2" align="left">NAMA</th>
                                <th class="py-2" align="left">NAMA</th>
                                <th class="py-2" align="left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-1 border-1 bg-green-50">testt</td>
                                <td class="py-2 px-1 border-1 bg-green-50">testt</td>
                                <td class="py-2 px-1 border-1 bg-green-50">testt</td>
                                <td class="py-2 px-1 border-1 bg-green-50">testt</td>
                                <td class="py-2 px-1 border-1 bg-green-50">testt</td>
                                <td class="py-2 px-1 border-1 bg-green-50 w-[300px]">
                                    <div class="flex">
                                        <div class="mx-1 p-2">
                                            <bi class="text-xl bi-eye-fill"></bi>
                                        </div>

                                        <div class="mx-1 p-2">
                                            <bi class="text-xl bi-trash-fill"></bi>
                                        </div>

                                        <div class="mx-1 p-2">
                                            <bi class="text-xl bi-pencil-fill"></bi>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-1 border-1">testt</td>
                                <td class="py-2 px-1 border-1">testt</td>
                                <td class="py-2 px-1 border-1">testt</td>
                                <td class="py-2 px-1 border-1">testt</td>
                                <td class="py-2 px-1 border-1">testt</td>
                                <td class="py-2 px-1 border-1"> <div class="flex">
                                    <div class="mx-1 p-2">
                                        <bi class="text-xl bi-eye-fill"></bi>
                                    </div>

                                    <div class="mx-1 p-2">
                                        <bi class="text-xl bi-trash-fill"></bi>
                                    </div>

                                    <div class="mx-1 p-2">
                                        <bi class="text-xl bi-pencil-fill"></bi>
                                    </div>
                                </div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-2">
                    <div class="rounded-full w-max h-[40px] bg-gray-100 flex items-center">
                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                            <i class="text-xl bi bi-chevron-left"></i>
                        </button>
                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] my-2 rounded-full p-1 px-2">
                            1
                        </button>
                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] my-2 rounded-full p-1 px-2">
                            2
                        </button>
                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                            <i class="text-xl bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
