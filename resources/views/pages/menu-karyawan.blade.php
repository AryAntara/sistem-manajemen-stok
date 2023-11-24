@extends('layouts.default')
@section('content')
    <div class="flex">
        <!-- Component Sidebar Start -->
        <x-sidebar>
            staff
        </x-sidebar>
        <!-- Component End  -->

        <!-- body -->
        <div class="m-16 mb-0 w-full">
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
                        <button class="bg-[#368D5B] text-xl rounded-full text-white p-2"
                            x-on:click="isShowModalAdd = !isShowModalAdd">
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
            <div class="w-full h-[600px] pb-8 pt-8">
                <div class="overflow-y-scroll h-full">
                    <table class="w-full border-1">
                        <thead class="text-[#368D5B] border-b font-bold align-left p-32">
                            <tr class="">
                                <th class="py-2" align="left">No</th>
                                <th class="py-2" align="left">Nama</th>
                                <th class="py-2" align="left">Jabatan</th>
                                <th class="py-2" align="left">Usia</th>
                                <th class="py-2" align="left">Username</th>
                                <th class="py-2" align="left">Address</th>
                                <th class="py-2" align="left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff_entries as $index => $employer_entry)
                                <tr>
                                    <td {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}>{{ ($page - 1)  * 10 + $index + 1 }}</td>
                                    <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        {{ $employer_entry->name }}</td>
                                    <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">testt
                                    </td>
                                    <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        {{ $employer_entry->age }} Tahun</td>
                                    <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        {{ $employer_entry->username }}</td>
                                    <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        {{ $employer_entry->phone_number }}</td>
                                    <td
                                        class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }} w-[300px]">
                                        <div class="flex">

                                            <div x-data='{isShowText: false, isShowModalDetail: false}'>
                                                <button
                                                    class="mx-1 p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center"
                                                    x-on:mouseover="isShowText = !isShowText"
                                                    x-on:mouseout="isShowText = !isShowText"
                                                    x-on:click="isShowModalDetail = true">
                                                    <bi class="text-xl bi-eye-fill mx-1"></bi>
                                                    <p x-show='isShowText' class="font-bold mx-1">detail</p>
                                                </button>


                                                @php
                                                    $id = 1;
                                                @endphp
                                                <x-karyawan-modal-detail>
                                                    {{ $id }}
                                                </x-karyawan-modal-detail>
                                            </div>


                                            <button x-data='{isShowText: false}'
                                                class="mx-1 p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center"
                                                x-on:mouseover="isShowText = !isShowText"
                                                x-on:mouseout="isShowText = !isShowText">
                                                <bi class="text-xl bi-trash-fill mx-1"></bi>
                                                <p x-show='isShowText' class="font-bold mx-1">delete</p>
                                            </button>
                                            <div x-data='{isShowText: false, isShowModalEdit: false}'>
                                                <button
                                                    class="mx-1 p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center"
                                                    x-on:mouseover="isShowText = !isShowText"
                                                    x-on:mouseout="isShowText = !isShowText"
                                                    x-on:click="isShowModalEdit = true">
                                                    <bi class="text-xl bi-pencil-fill mx-1"></bi>
                                                    <p x-show='isShowText' class="font-bold mx-1">edit</p>
                                                </button>

                                                @php
                                                    $id = 1;
                                                @endphp
                                                <x-karyawan-modal-edit>
                                                    {{ $id }}
                                                </x-karyawan-modal-edit>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-2">
                    <div class="rounded-full w-max h-[40px] bg-gray-100 flex items-center">

                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                            <i class="text-xl bi bi-chevron-left"></i>
                        </button>
                        @if ($staff_pages_length === 0)
                            <button class="bg-[#368D5B] text-white my-2 rounded-full p-1 px-2">
                                1
                            </button>
                        @endif
                        @for ($i = 1; $i < $staff_pages_length + 1; $i++)
                            <a href="{{ route('staff')."?page=$i&limit=10" }}">
                                <button
                                    class="my-2 rounded-full mx-1 p-2 px-4 {{ $page == $i ? 'bg-[#368D5B] text-white' : 'hover:bg-[#368D5B] hover:text-white  text-[#368D5B]' }}">
                                    {{ $i }}
                                </button>
                            </a>
                        @endfor
                        <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                            <i class="text-xl bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
