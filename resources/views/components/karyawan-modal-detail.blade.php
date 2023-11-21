<div x-show='isShowModalDetail'>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="w-screen h-screen absolute bg-gray-900 bg-opacity-50 top-0 left-0 flex justify-center items-center">
        <div class="bg-white rounded-2xl shadow-lg h-max flex flex-col items-center w-max px-24 pb-16">
            {{-- Profile Wrapper --}}
            <div class="rounded-full overflow-hidden w-64 h-64 bg-[#368D5B] mt-8">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-64 h-64">
            </div>
            {{-- Name --}}
            <p class="text-2xl font-bold text-[#368D5B] mt-4 border-b-2 pb-1 border-[#368D5B]">
                I Komang Ary antara
            </p>
            {{-- Role --}}
            <p class="text-xl mt-1 mb-2 font-bold"> Programmer </p>
            {{-- Detail data --}}
            <div class="grid grid-cols-2 gap-8 mt-8 text-gray-500">
                <div>
                    <p class="font-bold mb-2">Email :</p>
                    <div class="bg-orange-200 rounded-full ps-2 w-[300px] text-gray-900">
                        I Komang Ary Antara
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Hobi :</p>
                    <div class="bg-orange-200 rounded-full ps-2 w-[300px] text-gray-900">
                        Dengerin Musik
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Game Favorit :</p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-900">
                        Wild Rift
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Anime Favorit :</p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-900">
                        Kimi No Nawa
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">No Hp :</p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-900">
                        +1 111 222 342435
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Kelas :</p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-900">
                        Sistem Informasi
                    </div>
                </div>
            </div>
            {{-- Back button --}}

            <div class="w-full flex justify-end mt-8">
                <button class="bg-[#368D5B] p-2 rounded-full text-white px-4 mt-2 font-bold w-max" x-on:click="isShowModalDetail = false">
                    <i class="bi bi-x-circle-fill me-2"></i> Tutup</button>
            </div>

        </div>
    </div>
</div>
