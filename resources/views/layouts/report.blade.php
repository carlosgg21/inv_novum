<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <link href="{{ asset('assets/node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        html {
        margin: 0;
        }
        /* Primer valor: Margen superior (top)
        Segundo valor: Margen derecho (right)
        Tercer valor: Margen inferior (bottom)
        Cuarto valor: Margen izquierdo (left) */
        body {
        font-family: "Times New Roman", serif;
        margin: 10mm 15mm 10mm 10mm;
        }
    </style>
    @yield('css')
</head>
<body>
    <div class="container">
        <div class="report-content">
            @yield('content')

        </div>
    </div>
</body>
</html>