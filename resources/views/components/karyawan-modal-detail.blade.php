<div x-show='isShowModalDetail'>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="w-screen h-screen absolute bg-gray-900 bg-opacity-50 top-0 left-0 flex justify-center items-center">
        <div class="bg-white rounded-2xl shadow-lg h-max flex flex-col items-center w-max px-24 pb-16">
            {{-- Profile Wrapper --}}
            <div class="border-2 rounded-full overflow-hidden shadow-xl w-64 h-64 bg-[#368D5B] mt-8">
                <img src="{{ $profile_photo_url }}" alt="" class="w-64 h-64 object-cover">
            </div>
            {{-- Name --}}
            <p class="text-2xl font-bold text-[#368D5B] mt-4 border-b-2 pb-1 border-[#368D5B]">
                {{ $name }}
            </p>
            {{-- Role --}}
            <p class="text-xl mt-1 mb-2 font-bold"> {{ $role_staff }} </p>
            {{-- Detail data --}}
            <div class="grid grid-cols-2 gap-8 mt-8 text-gray-500">
                <div>
                    <p class="font-bold mb-2">Nomor HP </p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-600 px-4 font-bold">
                        {{ $phone_number }}
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Alamat </p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-600 px-4 font-bold">
                        {{ $address }}
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Gender :</p>
                    <div class="bg-orange-200 rounded-full p-2 px-4 w-[300px] text-gray-600 font-bold">                        
                        {{ $gender == 'man' ? 'Laki - Laki' : 'Perempuan'}}
                        
                    </div>
                </div>

                <div>
                    <p class="font-bold mb-2">Username </p>
                    <div class="bg-orange-200 rounded-full p-2 w-[300px] text-gray-600 px-4 font-bold">
                        {{ $username }}
                    </div>
                </div>

                <div class="col-span-2">
                    <p class="font-bold mb-2">Umur </p>
                    <div class="bg-orange-200 rounded-full p-2 text-gray-600 px-4 font-bold">
                        {{ $age }} Tahun
                    </div>
                </div>
            </div>
            {{-- Back button --}}

            <div class="w-full flex justify-end mt-8">
                <button class="bg-[#368D5B] p-2 shadow-xl rounded-full text-white px-4 mt-2 font-bold w-max"
                    x-on:click="isShowModalDetail = false">
                    <i class="bi bi-x-circle-fill me-2"></i> Tutup</button>
            </div>

        </div>
    </div>
</div>
