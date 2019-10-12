<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('components.layout.head')
<body class="bg-blue-600 bg-fixed leading-normal text-lg">
<div id="app" class="flex flex-col justify-between min-h-screen" v-cloak>
    @include('components.header.header')
    <div id="content-container" class="flex-1">
        @yield('content')
    </div>
    @include('components.footer.footer')
</div>
@include('components.scripts.scripts')
</body>
</html>