@extends("layouts.default")
@section('content')

<div class="bg-gray-200 mt-64 mx-64 px-64 rounded"  x-data="{ message: 'I ❤️ Alpine' }" x-text="message">
    Ini Dashboard Yak {x}
</div>

@endsection()