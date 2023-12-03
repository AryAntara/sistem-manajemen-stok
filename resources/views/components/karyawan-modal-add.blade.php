<div x-show='isShowModalAdd'>
    <form action="{{ route('staff.create') }}" enctype="multipart/form-data" id="staff-create">
        @csrf
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        <div
            class="w-screen h-screen fixed overflow-y-scroll bg-gray-900 bg-opacity-50 top-0 left-0 flex justify-center items-center">
            <div
                class="bg-white rounded-2xl shadow-lg h-max flex flex-col items-center w-max px-24 pb-16 absolute top-8 bottom-11">
                {{-- Profile Wrapper --}}
                <div class="rounded-full overflow-hidden w-64 h-64 bg-gray-700 mt-8 relative"
                    x-data='{ isShowPlaceholderImage: true}'>
                    <img src="" alt="" id="photo-profile-wrapper" class="w-64 h-64 object-cover">
                    <label for="photo-profile"
                        class="image-wrapper absolute w-full h-full flex items-center justify-center top-0 bg-gray-800 bg-opacity-50 border-4 border-dashed rounded-full"
                        x-on:click='isShowPlaceholderImage = false'>
                        <p x-show="isShowPlaceholderImage" class="w-64 text-3xl text-white text-center font-bold">
                            Klik untuk Menambahkan Gambar
                        </p>
                        <input type="file" class="hidden" id="photo-profile" x-on:change='$store.image.showImage(null)'
                            name="profile_photo" accept="image/jpg,image/png,image/jpeg">
                    </label>
                </div>
                {{-- Name --}}
                <div>
                    <input
                        class="text-2xl font-bold text-[#368D5B] mt-4 border-b-2 pb-1 border-[#368D5B] outline-none px-4"
                        name="name" placeholder="Write the name here...">
                    <bi class="bi-pencil-fill"></bi>
                </div>
                {{-- Role --}}
                <select class="text-xl mt-1 mb-2 font-bold outline-none border-b-2 w-max bg-white" name="role">
                    <option value="Programmer">Programmer</option>
                    <option value="2">Desainner</option>
                </select>
                {{-- Detail data --}}
                <div class="grid grid-cols-2 gap-8 mt-8 text-gray-600 font-bold">
                    <div>
                        <p class="font-bold mb-2">Nomor HP :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" type="number"
                            name="phone_number" placeholder="Masukan Nomor Hp...">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Alamat :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" name="address"
                            placeholder="Masukan Alamat...">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Tanggal Lahir :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" type="date"
                            placeholder="Masukan Tanggal lahir" name="birth_date">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Username :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" name="username"
                            placeholder="Masukan username...">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Gender :</p>
                        <select class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" name="gender">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="man">Laki - Laki</option>
                            <option value="woman">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <p class="font-bold mb-2">Password :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-full outline-none" type="password"
                            placeholder="Masukan Password..." name="password">
                    </div>

                </div>
                {{-- Back button --}}

                <div class="w-full flex justify-end mt-8">
                    <button class="bg-[#368D5B] mx-2 p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                        x-on:click='$store.form.sendPost("form#staff-create")' x-on:click="isShowModalAdd = false"
                        type="button">
                        <i class="bi bi-plus-circle-fill me-2"></i> Tambah</button>
                    <button class="bg-[#368D5B] p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                        x-on:click="isShowModalAdd = false">
                        <i class="bi bi-x-circle-fill me-2" type="button"></i> Batal</button>
                </div>

            </div>
        </div>
    </form>
</div>
