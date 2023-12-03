<div x-show='isShowModalEdit'>
    <form action="{{ route('staff.update', ['id' => $id]) }}" enctype="multipart/form-data"
        id="staff-edit-{{ $id }}">
        @csrf
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        <div
            class="w-screen h-screen fixed overflow-y-scroll bg-gray-900 bg-opacity-50 top-0 left-0 flex justify-center items-center">
            <div
                class="bg-white rounded-2xl shadow-lg h-max flex flex-col items-center w-max px-24 pb-16 absolute top-8 bottom-11">
                {{-- Profile Wrapper --}}
                <div class="rounded-full overflow-hidden w-64 h-64 bg-gray-700 bg-opacity-75 mt-8 relative"
                    x-data='{ isShowPlaceholderImage: true}'>
                    <img src="{{ $staff->profile_photo_url }}" alt=""
                        id="photo-profile-wrapper-{{ $id }}" class="w-64 h-64 object-cover">
                    <label for="photo-profile-{{ $id }}"
                        class="image-wrapper-{{ $id }} absolute w-full h-full flex items-center justify-center top-0 bg-gray-800 hover:bg-opacity-75 bg-opacity-50 border-4 border-dashed rounded-full"
                        x-on:click='isShowPlaceholderImage = false'>
                        <p x-show="isShowPlaceholderImage"
                            class="w-64 text-3xl text-white text-center font-bold text-opacity-0 hover:text-opacity-100 py-16">
                            Klik untuk Menganti Gambar
                        </p>
                        <input type="file" class="hidden" id="photo-profile-{{ $id }}"
                            x-on:change='$store.image.showImage("{{ $id }}")' name="profile_photo"
                            accept="image/jpg,image/png,image/jpeg">
                    </label>
                </div>
                {{-- Name --}}
                <div>
                    <input
                        class="text-2xl font-bold text-[#368D5B] mt-4 border-b-2 pb-1 border-[#368D5B] outline-none px-4"
                        name="name" placeholder="Write the name here..." value="{{ $staff->name }}">
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
                            name="phone_number" value="{{ $staff->phone_number }}" placeholder="Masukan nomor Hp...">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Alamat :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" name="address"
                            value="{{ $staff->address }}" placeholder="Masukan alamat...">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Tanggal Lahir :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" type="date"
                            value="{{ $staff->birth_date }}" placeholder="Mauskan Tanggal lahir" name="birth_date">
                    </div>

                    <div>
                        <p class="font-bold mb-2">Username :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-[300px] outline-none" name="username"
                            value="{{ $staff->username }}" placeholder="Masukan Username...">
                    </div>

                    <div class="col-span-2">
                        <p class="font-bold mb-2">Password :</p>
                        <input class="bg-orange-200 rounded-full p-2 px-4 w-full outline-none" type="password"
                            placeholder="Masukan password baru..." name="password">
                    </div>

                </div>
                {{-- Back button --}}

                <div class="w-full flex justify-end mt-8">
                    <button class="bg-[#368D5B] mx-2 p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                        x-on:click='$store.form.sendPost("form#staff-edit-{{ $id }}")' type="button">
                        <i class="bi bi-arrow-up-circle-fill me-2"></i> Update</button>

                    <button class="bg-[#368D5B] p-2 rounded-full text-white px-4 mt-2 font-bold w-max"
                        x-on:click="isShowModalEdit = false" type="button">
                        <i class="bi bi-x-circle-fill me-2"></i> Batal</button>
                </div>

            </div>
        </div>
    </form>
</div>
