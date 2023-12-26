@if ($page_length === 0)
    <button class="bg-[#368D5B] text-white my-2 rounded-full p-1 px-2">
        1
    </button>
@endif
@for ($i = 1; $i <= $page_length; $i++)
    <a href="{{ $route . "?page=$i&limit=10" }}">
        <button
            class="my-2 rounded-full mx-1 p-2 px-4 {{ $page == $i ? 'bg-[#368D5B] text-white' : 'hover:bg-[#368D5B] hover:text-white  text-[#368D5B]' }}">
            {{ $i }}
        </button>
    </a>
@endfor
