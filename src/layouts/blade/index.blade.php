<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- TODO --}}
        <title>@hasSection('title') @yield('title') @else MVC Example By NeutronStars @endif</title>

        @hasSection('style')
            @yield('style')
        @else
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
            <link rel="stylesheet" href="/assets/css/highlightjs.css">
            <link rel="stylesheet" href="/assets/css/style.css">
        @endif

        @hasSection('script')
            @yield('script')
        @else
            <script src="/assets/js/highlightjs.js"></script>
            <script src="/assets/js/app.js" defer></script>
        @endif
    </head>
    <body>

        @hasSection('header')
            @yield('header')
        @else
            @include('header')
        @endif

        @yield('content')

        @hasSection('footer')
            @yield('footer')
        @endif
    </body>
</html>
