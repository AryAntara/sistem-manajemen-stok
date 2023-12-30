@extends('layouts.default')
@section('content')
    <div class="flex">
        <!-- Component Sidebar Start -->
        <x-sidebar>
            product
        </x-sidebar>
        <!-- Component End  -->

        <!-- body -->
        <div class="m-16 mb-0 w-full" x-data='{isAdded: false}'>
            <div class="h-36">
                <div class="text-[#368D5B] font-bold text-3xl">
                    Produk
                </div>
                <div class="flex justify-between items-center mt-10">
                    <form>
                        <div class="bg-[#368D5B] w-max p-1 rounded-full h-max">
                            <i class="bi mx-2 bi-search text-white"></i>
                            <input type="text"
                                class="w-auto bg-[#368D5B] outline-none text-white mx-2 p-1 placeholder-white"
                                placeholder="Cari nama produk..." name="q" value="{{ $query ?? '' }}">
                        </div>
                    </form>

                    <div x-show='!isAdded'>
                        <button class="bg-[#368D5B] text-xl rounded-full text-white p-2 shadow-xl border-2"
                            x-on:click="isAdded = !isAdded">
                            <i class="text-2xl bi bi-plus-circle-fill m-1"></i>
                        </button>
                    </div>
                </div>
            </div>
                <div class="w-full h-[600px] pb-14 pt-0 border-2 shadow-xl rounded-xl">
                    <div class="overflow-y-scroll h-full">
                        <table class="w-full px-4">
                            <thead class="text-[#368D5B] border-b font-bold align-left p-32">
                                <tr class="">
                                    <th class="py-2" align="center">No</th>
                                    <th class="py-2 w-64" align="left">Foto</th>
                                    <th class="py-2" align="left">Nama</th>
                                    <th class="py-2" align="left">Kode</th>
                                    <th class="py-2" align="left">Jenis</th>
                                    <th class="py-2" align="left">Harga</th>
                                    <th class="py-2" align="left">Stok</th>
                                    <th class="py-2" align="left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($product_entries as $index => $product_entry)
                                    @php
                                        $no = ($page - 1) * 10 + $index + 1;
                                    @endphp
                                    <tr x-data='{isEdited: false}' id="product-edit-{{ $product_entry->id }}">
                                        <form>
                                            <td class="{{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }} font-bold"
                                                align="center">
                                                {{ $no }}.</td>
                                            <td class="py-2 px-4 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                {{-- {{ $product_entry->image }} --}}
                                                <div x-show="!isEdited" class="w-64 h-32 relative overflow-hidden rounded-full">
                                                    <img src="{{ $product_entry->image_url }}" alt="">
                                                </div>

                                                <div
                                                    x-show="isEdited"
                                                    class="border-4 relative border-black bg-green-400 border-dashed w-64 h-32 flex items-center justify-center overflow-hidden rounded-full bg-opacity-50">
                                                    <div class="image-wrapper">
                                                        <img src="{{ $product_entry->image_url }}" alt="">
                                                    </div>

                                                    <label for="product-image-edit-{{ $product_entry->id }}" class="absolute">
                                                        <div
                                                            class="p-2 px-3 mx-4 rounded-full bg-black hover:text-black hover:bg-green-500 text-green-500 border-white border-2">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </div>
                                                        <input name="image" type="file" accept="image/png"
                                                            id="product-image-edit-{{ $product_entry->id }}" class="hidden"
                                                            x-on:change='$store.product.showImage({{$product_entry->id}})'>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <span x-show='!isEdited'>{{ $product_entry->name }}</span>
                                                <input x-show='isEdited'
                                                    class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                                    placeholder="Nama" name="name" value="{{ $product_entry->name }}">
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <span x-show='!isEdited'>{{ $product_entry->code }}</span>
                                                <input x-show='isEdited'
                                                    class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                                    placeholder="Kode" name="code" value="{{ $product_entry->code }}">
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <span x-show='!isEdited'>{{ $product_entry->category }}</span>
                                                <input x-show='isEdited'
                                                    class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                                    placeholder="Jenis" name="category"
                                                    value="{{ $product_entry->category }}">
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <span x-show='!isEdited'>{{ $product_entry->price_in_k }}</span>
                                                <input x-show='isEdited'
                                                    class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                                    placeholder="Harga" name="price" value="{{ $product_entry->price }}">
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <span>{{ $product_entry->stock_final }} Unit</span>
                                            </td>
                                            <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                                <div class="flex">

                                                    {{-- Save Data --}}
                                                    <button x-show="isEdited"
                                                        class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                        type="button"
                                                        x-on:click='$store.axios.sendPost("{{ route('product.update', ['id' => $product_entry->id]) }}","#product-edit-{{$product_entry->id}}")'>
                                                        <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                                                    </button>

                                                    {{-- Edit --}}
                                                    <button x-show="!isEdited"
                                                        class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                        type="button" x-on:click="isEdited = true">
                                                        <bi class="text-xl bi-pencil-fill mx-1"></bi>
                                                    </button>

                                                    {{-- Cancel --}}
                                                    <button x-show="isEdited" x-data='{isShowText: false}'
                                                        class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                        type="button" x-on:click='isEdited = false'>
                                                        <bi class="text-xl bi-x-circle-fill mx-1"></bi>
                                                    </button>

                                                    {{-- Delete --}}
                                                    <div x-data='{isShowAlert: false}'>
                                                        <button x-data='{isShowText: false}'
                                                            class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                            type="button" x-on:click="isShowAlert = true">
                                                            <bi class="text-xl bi-trash-fill mx-1"></bi>
                                                        </button>
                                                        <x-alert>
                                                            {{-- Alert Yes --}}
                                                            <a href="{{ route('product.delete', ['id' => $product_entry->id]) }}"
                                                                class="w-max h-max bg-gray-200 text-center font-bold p-2 m-2 pe-4 rounded-full">
                                                                <div class="flex w-auto justify-left">
                                                                    <i class="bi bi-check-circle-fill me-2"></i>
                                                                    <p class="font-bold">Ya</p>
                                                                </div>
                                                            </a>
                                                        </x-alert>
                                                    </div>

                                                </div>
                                            </td>
                                    </tr>
                                @endforeach
                                </tr>
                                {{-- Create --}}
                                <tr x-show='isAdded' class="border-4 border-gray-300 border-dashed" id="product-create">
                                    @php
                                        $data_count = $product_entries->count();
                                        $no = $no + 1;
                                    @endphp

                                    <td class="{{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }} font-bold"
                                        align="center">
                                        {{ $no }}.</td>
                                    <td class="py-2 px-4 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        {{-- Image --}}
                                        <div
                                            class="border-4 relative border-black bg-green-400 border-dashed w-64 h-32 flex items-center justify-center overflow-hidden rounded-full bg-opacity-50">
                                            <div class="image-wrapper">
                                                <i class="text-[100px] bi bi-image"></i>
                                            </div>

                                            <label for="product-image-create" class="absolute">
                                                <div
                                                    class="p-2 px-3 mx-4 rounded-full bg-black hover:text-black hover:bg-green-500 text-green-500 border-white border-2">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </div>
                                                <input name="image" type="file" accept="image/png"
                                                    id="product-image-create" class="hidden"
                                                    x-on:change='$store.product.showImage'>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <input class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Nama" name="name">
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <input class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Kode" name="code">
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <input class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Jenis" name="category">
                                    <td colspan="2" class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <input class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Harga" name="price">
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <div class="flex">
                                            {{-- Save Data --}}
                                            <button
                                                class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                type="button" x-on:click='$store.axios.sendPost("{{route('product.create')}}","#product-create")'>
                                                <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                                            </button>

                                            {{-- Cancel --}}
                                            <button x-data='{isShowText: false}'
                                                class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                type="button" x-on:click='isAdded = false'>

                                                <bi class="text-xl bi-x-circle-fill mx-1"></bi>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @if ($product_entries->count() < 1)
                            <div class="w-100% text-3xl mt-24 font-bold text-gray-900/75 flex justify-center items-center">
                                Data
                                Kosong</div>
                        @endif

                    </div>
                    <div class="flex justify-end mt-2 me-2">
                        <div class="rounded-full w-max h-[40px] bg-gray-100 flex items-center">

                            <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                                <i class="text-xl bi bi-chevron-left"></i>
                            </button>

                            <x-paginate :pagelength="$page_length" :page="$page" :route="route('product')"></x-paginate>

                            <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                                <i class="text-xl bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection
