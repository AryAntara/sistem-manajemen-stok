<div x-show='isShowModalEdit'>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="w-screen h-screen absolute bg-gray-900 bg-opacity-50 top-0 left-0 flex justify-center items-center">
        <div class="bg-white rounded-2xl shadow-lg h-max flex flex-col items-center w-max px-24 pb-16">
            {{-- Profile Wrapper --}}
            <div class="rounded-full overflow-hidden w-64 h-64 bg-[#368D5B] mt-8 relative">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-64 h-64">
                <div class="absolute w-full h-full flex items-center justify-center top-0 bg-gray-800 bg-opacity-50">
                    <button class="top-1/2 left-1/2 bg-[#368D5B] p-2 border-2 rounded-full">
                        <i class="bi bi-image text-white m-1"></i>
                    </button>
                </div>
            </div>
            {{-- Name --}}
            <div>
                <input class="text-2xl font-bold text-[#368D5B] mt-4 border-b-2 pb-1 border-[#368D5B] outline-none" value="I Komang Ary antara" placeholder="Write the name here...">
                <bi class="bi-pencil-fill"></bi>
            </div>

            {{-- Role --}}
            <select class="text-xl mt-1 mb-2 font-bold outline-none border-b-2 w-max bg-white">
                <option value="Programmer">Programmer</option>
                <option value="2">Desainner</option>
            </select>
            {{-- Detail data --}}
            <div class="grid grid-cols-2 gap-8 mt-8 text-gray-500">
                <div>
                    <p class="font-bold mb-2">Email :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="I Komang Ary Antara">
                </div>

                <div>
                    <p class="font-bold mb-2">Hobi :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="Dengerin Musik">
                </div>

                <div>
                    <p class="font-bold mb-2">Game Favorit :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="Wild Rift">
                </div>

                <div>
                    <p class="font-bold mb-2">Anime Favorit :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="Kimi No Nawa">
                </div>

                <div>
                    <p class="font-bold mb-2">No Hp :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="+1 111 222 342435">
                </div>

                <div>
                    <p class="font-bold mb-2">Kelas :</p>
                    <input class="bg-orange-200 rounded-full p-2 w-[300px]" value="Sistem Informasi">
                </div>
            </div>
            {{-- Back button --}}

            <div class="w-full flex justify-end mt-8">
                <button class="bg-[#368D5B] mx-2 p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                    x-on:click="isShowModalEdit = false">
                    <i class="bi bi-arrow-up-circle-fill me-2"></i> Update</button>
                <button class="bg-[#368D5B] p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                    x-on:click="isShowModalEdit = false">
                    <i class="bi bi-x-circle-fill me-2"></i> Batal</button>
            </div>

        </div>
    </div>
</div>
