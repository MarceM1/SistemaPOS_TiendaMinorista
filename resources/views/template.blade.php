<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Ssitema de venta de abarrotes" />
    <meta name="author" content="Marcelo Melogno" />
    <title>Sistema Ventas | @yield('title')</title>
    
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    @stack('css')
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <x-navigation-header/> 

    <div id="layoutSidenav">
        <x-navigation-menu/>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <x-footer/>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('js')
    
</body>

</html>
