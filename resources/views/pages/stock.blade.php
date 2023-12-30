@extends('layouts.default')
@section('content')
    <div class="flex">
        <!-- Component Sidebar Start -->
        <x-sidebar>
            stock
        </x-sidebar>
        <!-- Component End  -->

        <!-- body -->
        <div class="w-full w-100% h-[100vh] overflow-y-scroll">
            <div class="m-16 mb-0" x-data='{isAdded: false}'>
                <div class="h-36">
                    <div class="text-[#368D5B] font-bold text-3xl">
                        Stok
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
                <div class="w-full h-max pb-14 pt-0 border-2 shadow-xl rounded-xl">
                    <div class="overflow-y-scroll h-full">
                        <table class="w-full px-4">
                            <thead class="text-[#368D5B] border-b font-bold align-left p-32">
                                <tr class="">
                                    <th class="py-2" align="center">No</th>
                                    <th class="py-2" align="left">Nama Barang</th>
                                    <th class="py-2" align="left">Kode Barang</th>
                                    <th class="py-2" align="left">Harga</th>
                                    <th class="py-2" align="left">Jumlah</th>
                                    <th class="py-2" align="left">Type</th>
                                    <th class="py-2" align="left">Alasan</th>
                                    <th class="py-2" align="left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($stock_in_out_entries as $index => $stock_entry)
                                    @php
                                        $no = ($page - 1) * 10 + $index + 1;
                                    @endphp
                                    <tr x-data='{isEdited: false}' id="stock-edit-{{ $stock_entry->id }}">
                                        <td class="{{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }} font-bold"
                                            align="center">
                                            {{ $no }}.</td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->product_name }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->product_code }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>Rp. {{ number_format($stock_entry->price) }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span x-show='!isEdited'>{{ $stock_entry->qty }}</span>
                                            <input x-show='isEdited'
                                                class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                                placeholder="Harga" name="qty" value="{{ $stock_entry->qty }}">
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->type }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }} w-[300px]">
                                            <span class="" x-show='!isEdited'>{{ $stock_entry->reason }}</span>
                                            <textarea x-show="isEdited" class="w-[300px] p-4 bg-transparent outline-none border-2 border-black" placeholder="Jenis"
                                                name="reason">{{ $stock_entry->reason }}</textarea>
                                        </td>

                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <div class="flex">
                                                {{-- Save Data --}}
                                                <button x-show="isEdited"
                                                    class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                    type="button"
                                                    x-on:click='$store.axios.sendPost("{{ route('stock.update', ['id' => $stock_entry->id, 'type' => $stock_entry->type == 'masuk' ? 'in' : 'out']) }}","#stock-edit-{{ $stock_entry->id }}")'>
                                                    <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                                                </button>

                                                {{-- Edit --}}
                                                <button x-show="!isEdited"
                                                    class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                    type="button" x-on:click="isEdited = true">
                                                    <bi class="text-xl bi-pencil-fill mx-1"></bi>
                                                </button>

                                                {{-- Cancel --}}
                                                <button x-show="isEdited"
                                                    class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                    type="button" x-on:click='isEdited = false'>
                                                    <bi class="text-xl bi-x-circle-fill mx-1"></bi>
                                                </button>

                                                {{-- Publish --}}
                                                <a x-show="!isEdited"
                                                    href="{{ route('stock.publish', ['id' => $stock_entry->id, 'type' => $stock_entry->type == 'masuk' ? 'in' : 'out']) }}"
                                                    class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                    type="button" x-on:click='isEdited = false'>
                                                    <bi class="text-xl bi-arrow-up-circle-fill mx-1"></bi>
                                                </a>

                                                {{-- Delete --}}
                                                <div x-data='{isShowAlert: false}'>
                                                    <button
                                                        class="mx-1 shadow-xl p-2 rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                        type="button" x-on:click="isShowAlert = true">
                                                        <bi class="text-xl bi-trash-fill mx-1"></bi>
                                                    </button>
                                                    <x-alert>
                                                        {{-- Alert Yes --}}
                                                        <a href="{{ route('stock.delete', ['id' => $stock_entry->id, 'type' => $stock_entry->type == 'masuk' ? 'in' : 'out']) }}"
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
                                @if ($stock_in_out_entries->count() < 1)
                                    <td colspan="9" align="center" x-show='!isAdded'>
                                        <div class="text-gray-800 font-bold mt-4">Tidak ada pengajuan stok masuk maupun
                                            keluar</div>
                                    </td>
                                @endif
                                </tr>
                                {{-- Create --}}
                                <tr x-show='isAdded' class="h-[100px] border-4 border-gray-300 border-dashed"
                                    id="stock-create">
                                    @php
                                        $data_count = $product_entries->count();
                                        $no = $no + 1;
                                    @endphp

                                    <td class="{{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }} font-bold"
                                        align="center">
                                        {{ $no }}.</td>
                                    <td colspan="3"
                                        class="py-2 px-4 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <select class="w-full bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Product" name="product_id">
                                            @foreach ($product_entries as $product_entry)
                                                <option value="{{ $product_entry->id }}">{{ $product_entry->name }}
                                                    ({{ $product_entry->code }})
                                                    - {{ $product_entry->price_in_k }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <input class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            type="number" placeholder="Jumlah" name="qty">
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <select class="w-[100px] bg-transparent outline-none border-b-2 border-black"
                                            placeholder="Jenis" name="type">
                                            <option value="in">Masuk</option>
                                            <option value="out">Keluar</option>
                                        </select>
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <textarea class="w-[300px] p-4 bg-transparent outline-none border-2 border-black" placeholder="Tulis Alasan..." name="reason"></textarea>
                                    </td>
                                    <td class="py-2 {{ $data_count % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                        <div class="flex">
                                            {{-- Save Data --}}
                                            <button
                                                class="mx-1 p-2 shadow-xl rounded-full w-max text-white bg-[#368D5B] flex items-center hover:bg-white hover:text-[#368D58]"
                                                type="button"
                                                x-on:click='$store.axios.sendPost("{{ route('stock.create') }}","#stock-create")'>
                                                <bi class="text-xl bi-floppy2-fill mx-1"></bi>
                                            </button>

                                            {{-- Cancel --}}
                                            <button
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
                            <div x-show='isEmpty' class="w-100% text-3xl mt-24 font-bold text-gray-900/75 flex justify-center items-center">
                                Data
                                Kosong</div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="m-16 mb-16" x-data='{isAdded: false}'>
                <div class="h-36">
                    <div class="text-[#368D5B] font-bold text-3xl">
                        History Stok
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
                    </div>
                </div>
                <div class="w-full h-max pb-14 pt-0 border-2 shadow-xl rounded-xl">
                    <div class="overflow-y-scroll h-min-[100px]">
                        <table class="w-full px-4">
                            <thead class="text-[#368D5B] border-b font-bold align-left p-32">
                                <tr class="">
                                    <th class="py-2" align="center">No</th>
                                    <th class="py-2" align="left">Nama Barang</th>
                                    <th class="py-2" align="left">Pengaju</th>
                                    <th class="py-2" align="left">Stok Masuk</th>
                                    <th class="py-2" align="left">Stok Keluar</th>
                                    <th class="py-2" align="left">Stok Akhir</th>
                                    <th class="py-2" align="left">Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($stock_entries as $index => $stock_entry)
                                    @php
                                        $no = ($page - 1) * 10 + $index + 1;
                                    @endphp
                                    <tr id="product-edit-{{ $stock_entry->id }}">
                                        <td class="{{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }} font-bold"
                                            align="center">
                                            {{ $no }}.</td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->product_name .' - '. ($stock_entry->product_code) }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->staff->name }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ number_format($stock_entry->stock_in) }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ number_format($stock_entry->stock_out) }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ number_format($stock_entry->stock_final) }}</span>
                                        </td>
                                        <td class="py-2 {{ $index % 2 == 0 ? 'bg-green-50' : 'bg-white' }}">
                                            <span>{{ $stock_entry->created_at }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>

                        @if ($stock_entries->count() < 1)
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

                            <x-paginate :pagelength="$page_length" :page="$page" :route="route('stock')"></x-paginate>

                            <button class="hover:bg-[#368D5B] hover:text-white text-[#368D5B] m-2 rounded-full p-1 px-2">
                                <i class="text-xl bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
