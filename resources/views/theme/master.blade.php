<!DOCTYPE html>
<html lang="en">

@include('theme.partisal.head')

<body>

    @include('theme.partisal.header')

    <main class="site-main">

        @include('theme.partisal.hero')


        @yield('content')
    </main>


    @include('theme.partisal.footer')


    @include('theme.partisal.scripts')
</body>

</html>
