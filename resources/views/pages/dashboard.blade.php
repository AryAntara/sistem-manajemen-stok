@extends('layouts.default')
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
                    Kappa Cafe Unhi
                </div>
                <div class="mt-10">
                    <div class="flex text-2xl font-bold">
                        <i class="bi bi-people-fill me-4"></i>
                        <span>Data Karyawan</span>
                    </div>
                    <div class="border-2 mt-2 rounded-xl bg-white/75 flex p-16 justify-between shadow-xl">
                        <div class="flex justify-center w-auto">
                            <i class="bi bi-person-standing text-orange-400 text-[100px]"></i>
                            <div class="font-bold  text-[#368D5B] flex flex-col justify-center">
                                <p class="text-[50px] h-max p-0 text-center">{{ $count_men_staff }}</p><span class="text-[25px]">Staff</span>
                            </div>
                        </div>

                        <div class="border-2 my-4 border-gray-300"></div>

                        <div class="flex justify-center">
                            <i class="bi bi-person-standing-dress text-yellow-400 text-[100px]"></i>
                            <div class="font-bold  text-[#368D5B] flex flex-col justify-center">
                                <p class="text-[50px] h-max p-0 text-center">{{ $count_women_staff }}</p><span class="text-[25px]">Staff</span>
                            </div>
                        </div>

                        <div class="border-2 my-4 border-gray-300"></div>

                        <div class="flex justify-center">
                            <p class="text-[75px] my-auto text-[#368D5B] font-bold h-max me-8 p-0">{{ $count_staff }}</p>
                            <div class="font-bold  text-[#368D5B] flex flex-col justify-center">
                                <p class="text-[50px] h-max p-0">Total</p><span class="text-[25px]">Staff</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
