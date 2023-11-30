<!DOCTYPE html>
<html lang="en">
<head>
    @include("includes.head")
</head>
<body>

    {{-- Loader --}}
    <x-loader></x-loader>

    @yield('content')
    <div>
        @include("includes.footer")
    </div>
</body>
</html>