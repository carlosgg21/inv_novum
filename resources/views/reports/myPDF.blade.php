@extends('layouts.report')

@section('content')
<h1>{{ $title }}</h1>
<p>{{ $date }}</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.</p>



<table class="table table-bordered table-sm">

    <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Email</th>

    </tr>

    @foreach($users as $product)

    <tr>

     <td>{{ $product->code ?? '-' }}</td>
    
    
    <td>
        {{-- <span class="text-muted"><small> {{ $product->category->name }} </small></span><br>
        <span class="font-weight-bold"> {{ $product->name ?? '-' }}</span><br>
        <span class="text-primary"> {{ $product->brand?->name }}</span> --}}
    
    
        <span class="font-weight-bold"> {{ $product->name ?? '-' }}</span><br>
        <span class="text-muted"><small> {{ $product->category->name }} </small></span> <span class="text-primary"> {{
            $product->brand?->name }}</span>
    
    </td>
    <td class="text-center font-weight-bold"> {{ $product->qty ?? 0 }}<br>
        {{-- <span class="text-muted"><small> {{ $product->min_qty ?? 0 }} - {{
                $product->max_qty ?? 0 }} </small></span> --}}
    
    </td>
    
    <td>{{ $product->unit ?? '-' }}<br>
        <span class="text-muted"><small> {{ $product->size ?? '-' }}</small></span>
    
    
    </td>
    <td class="text-right">{{ $product->unit_price ? format_money($product->unit_price): '0.00'}}</td>
    <td class="text-right">{{ $product->cost_price ? format_money($product->cost_price): '0.00'}}</td>
    
    <td class=" text-center {{ $product->average_margin < 10 ? 'text-danger' : '' }}">
        {{ $product->average_margin != 0 ? format_percentage($product->average_margin) : '-' }}
    </td>

    </tr>

    @endforeach

</table>
@endsection