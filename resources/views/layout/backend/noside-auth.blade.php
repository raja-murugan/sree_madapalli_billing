<!DOCTYPE html>
<html lang="en">

<head>

    @include('layout.backend.components.auth.head')

</head>

<body>

    <div>

        <section class="preloader">
            {{-- @include('layout.backend.components.auth.loader') --}}
        </section>

        <section class="top-bar">
            @include('layout.backend.components.auth.top-bar')
        </section>

        <section class="main">
            @yield('content')
        </section>

    </div>

    @include('layout.backend.components.auth.script')

    @include('layout.backend.components.auth.addon.toastr')

</body>

</html>
