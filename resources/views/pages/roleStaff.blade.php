@extends('layouts.default')
@section('content')
    <div class="flex">
        <!-- Component Sidebar Start -->
        <x-sidebar>
            role_staff
        </x-sidebar>
        <!-- Component End  -->

        <!-- body -->
        <div class="m-16 mb-16 w-full" x-data='{isAdded: false}'>
            <div class="h-36">
                <div class="text-[#368D5B] font-bold text-3xl">
                    Jabatan
                </div>
                <div class="flex justify-between items-center mt-10">
                    <div x-show='!isAdded'>
                        <button class="bg-[#368D5B] text-xl rounded-full text-white p-2 shadow-xl border-2"
                            x-on:click="isAdded = !isAdded">
                            <i class="text-2xl bi bi-plus-circle-fill m-1"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 rounded-xl text-white">

                @foreach ($role_staff_entries as $role_staff_entry)
                    <div class="bg-[#368D5B] flex p-4 rounded-full justify-between" x-data="{ isEdited: false }" id="role-staff-edit-{{ $role_staff_entry->id }}">
                        <div class="mx-16 flex flex-col">
                            <p x-show="!isEdited" class="py-2 text-[50px] font-bold">{{ $role_staff_entry->label }}</p>
                            <input x-show="isEdited" placeholder="Label" name="label"
                                value="{{ $role_staff_entry->label }}"
                                class="py-2 text-[50px] font-bold bg-transparent outline-none w-[350px]">
                            <hr>
                            <p x-show="!isEdited" class="py-2 text-[16px]">{{ $role_staff_entry->description }}</p>
                            <input x-show="isEdited" name='description' value="{{ $role_staff_entry->description }}"
                                class="bg-transparent border-b-2 py-2 text-[16px] outline-none" placeholder="description">
                        </div>
                        <div class="flex flex-col mx-8">

                            {{-- Save Data --}}
                            <button x-show='isEdited'
                                class="border-2 mx-1 p-2 m-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                type="button"
                                x-on:click='$store.axios.sendPost("{{ route('roleStaff.update', ['id' => $role_staff_entry->id]) }}","#role-staff-edit-{{ $role_staff_entry->id }}")'>
                                <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                            </button>

                            {{-- Edit --}}
                            <button x-show="!isEdited"
                                class="border-2 mx-1 p-2 m-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                type="button" x-on:click="isEdited = true">
                                <bi class="text-xl bi-pencil-fill mx-1"></bi>
                            </button>

                            {{-- Delete --}}
                            <div x-data='{isShowAlert: false}'>
                                <button
                                    class="border-2 m-2 mx-1 m-2 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                    type="button" x-on:click="isShowAlert = true">
                                    <bi class="text-xl bi-trash-fill mx-1"></bi>
                                </button>
                                <x-alert>
                                    {{-- Alert Yes --}}
                                    <a href="{{ route('roleStaff.delete', ['id' => $role_staff_entry->id]) }}"
                                        class="w-max h-max bg-gray-200 text-center font-bold p-2 m-2 pe-4 rounded-full">
                                        <div class="flex w-auto justify-left">
                                            <i class="bi bi-check-circle-fill text-black me-2"></i>
                                            <p class="font-bold text-black">Ya</p>
                                        </div>
                                    </a>
                                </x-alert>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div x-show="isAdded" class="bg-white border flex p-4 rounded-full justify-between" id="role-staff-create">
                    <div class="mx-16 flex flex-col">
                        <input placeholder="Label" name="label"
                            class="py-2 text-[50px] font-bold bg-transparent text-[#368D5B] outline-none w-[350px]">
                        <hr>
                        <input name='description'
                            class="bg-transparent border-b-2 py-2 text-[16px] text-[#368D5B] outline-none"
                            placeholder="description">
                    </div>
                    <div class="flex flex-col mx-8">
                        {{-- Save Data --}}
                        <button
                            class="border-2 mx-1 p-2 m-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                            type="button"
                            x-on:click='$store.axios.sendPost("{{ route('roleStaff.create') }}","#role-staff-create")'>
                            <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                        </button>

                        {{-- Cancel --}}
                        <button
                            class="border-2 mx-1 m-2 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                            type="button" x-on:click='isAdded = false'>

                            <bi class="text-xl bi-x-circle-fill mx-1"></bi>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
