<div x-show="isShowAlert">
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <div class="absolute bg-gray-900 bg-opacity-50 top-0 left-0 w-screen h-screen flex justify-center items-center">
        <div class="w-[450px] h-max bg-white rounded-xl flex flex-col items-center">
            {{-- icon --}}
            <div class="px-4">
                <i class="bi bi-exclamation-triangle-fill text-[100px] text-yellow-500 m-2"></i>
                <p class="font-bold text-3xl text-center text-black">Warning</p>
            </div>
            <div class="text-xl m-4 my-6 mb-4 text-center text-black">
                Yakin kamu ingin mengahapus data ini ?
            </div>
            <div class="flex w-full m-4 justify-center">
                {{ $slot }}
                <button  x-on:click='isShowAlert = false' class="w-max h-max bg-red-500 text-white p-2 m-2 rounded-full">
                    <div class="flex w-auto justify-left">
                        <i class="bi bi-x-circle-fill me-2"></i> <p class="font-bold">Tidak</p>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
