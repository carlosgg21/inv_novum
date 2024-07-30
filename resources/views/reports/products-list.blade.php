<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{{ $title }}</title>
    <style>
        @page {
            margin: 100px 25px;
            /* Margen superior e inferior */
        }

        header {
            position: fixed;
            left: 0;
            top: -80px;
            /* Ajusta según el tamaño del header */
            right: 0;
            height: 60px;
            /* text-align: center; */
            /* line-height: 35px; */
            /* background-color: #ADD8E6; */
            /* Color azul claro */
        }

        footer {
            position: fixed;
            left: 0;
            bottom: -70px;
            /* Ajusta según el tamaño del footer */
            right: 0;
            height: 60px;
            text-align: center;
            /* line-height: 5px; */
            /* background-color: #ADD8E6; */
            /* Color azul claro */
        }

        .page-number {
            text-align: right;
            font-size: 11px;
        }

        .page-number:before {
            content: "Page " counter(page);
        }

        main {
            /* padding: 20px; */
            padding-bottom: 40px;
            /* Espacio para el footer */
        }
    </style>

    <link href="{{ asset('assets/node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <header>
<h5  style="text-align: center;text-transform: uppercase;">{{ $title }}</h5>
    </header>

    <footer>
        <hr>


        <div class="page-number"></div>

    </footer>

    <main>

        
        <table class="table table-bordered table-sm" style="font-size: 10">
            <thead class="thead-light">
                <tr>
                    <th>CODE</th>
                    <th>PRODCUT</th>

                    <th>UNT</th>
                    <th>PRICE</th>
                    <th>COST</th>
                    <th>QTY</th>
                    <th>TOTAL PRICE</th>
                    <th>TOTAL COST</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->code ?? '-' }}</td>
                    <td>
                        <span class="font-weight-bold"> {{ $product->name ?? '-' }}</span><br>
                        <span class="text-muted"><small> {{ $product->category->name }} </small></span> <span
                            class="text-primary"> {{
                            $product->brand?->name }}</span>
                    </td>
                    <td>
                        {{ $product->unit->name ?? '-' }}<br>
                        <span class="text-muted"><small> {{ $product->size ?? '-' }}</small></span>

                    </td>
                    <td class="text-right">{{ $product->unit_price ? format_money($product->unit_price): '0.00'}}</td>
                    <td class="text-right">{{ $product->cost_price ? format_money($product->cost_price): '0.00'}}</td>
                    <td class="text-center font-weight-bold"> {{ $product->qty ?? 0 }}</td>
                    <td class="text-right">{{ $product->unit_price ? format_money($product->unit_price * $product->qty)
                        :
                        '0.00'}}</td>
                    <td class="text-right">{{ $product->cost_price ? format_money($product->cost_price * $product->qty):
                        '0.00'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>
</body>

</html>