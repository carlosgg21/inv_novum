<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/invoice_style.css') }}" type="text/css" media="all" />
</head>

<body>
    <div>
        <div class="py-4">
            <div class="px-14 py-6">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-full align-top">
                                {{-- <div>
                                    <img src="https://menkoff.com/assets/brand-sample.png" class="h-12" />
                                </div> --}}
                                <p class="whitespace-nowrap font-bold text-main" style="text-transform: uppercase">
                                    {{ $title }}
                                </p>
                              </td>
                            @if($salesOrder->is_invoiced)
                                <td class="align-top">
                                    <div class="text-sm">
                                        <table class="border-collapse border-spacing-0">
                                            <tbody>
                                                <tr>
                                                    <td class="border-r pr-4">
                                                        <div>
                                                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice Date</p>
                                                            <p class="whitespace-nowrap font-bold text-main text-right">
                                                                {{ format_date($salesOrder->invoice_date, 'd/m/Y') }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="pl-4">
                                                        <div>
                                                            <p class="whitespace-nowrap text-slate-400 text-right">Due Date
                                                            </p>
                                                            <p class="whitespace-nowrap font-bold text-main text-right">
                                                                {{ isset($salesOrder->invoices[0]) ? $salesOrder->invoices[0]->number : '' }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="pl-4">
                                                        <div>
                                                            <p class="whitespace-nowrap text-slate-400 text-right">Invoice No.
                                                            </p>
                                                            <p class="whitespace-nowrap font-bold text-main text-right">
                                                                {{ isset($salesOrder->invoices[0]) ? $salesOrder->invoices[0]->number : '' }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            @endif                                    
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-100 px-14 py-6 text-sm">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-1/2 align-top">
                                <div class="text-sm text-neutral-600">
                                    <p class="font-bold">{{ company()->name }}</p>
                                    <p><strong>NIT:</strong> {{ company()->code }}</p>
                                    <p>{!! format_address(company()->addresses->full_address) !!}</p>
                                    <p><strong>Phone:</strong> {{ company()->phone }}</p>
                                    <p><strong>Email:</strong> {{ company()->email }}</p>
                                    
                                    {{-- <p>{!! nl2br(format_address(company()->addresses->full_address)) !!}</p> --}}
                                    {{-- <p>Number: 23456789</p>
                                    <p>VAT: 23456789</p>
                                    <p>6622 Abshire Mills</p>
                                    <p>Port Orlofurt, 05820</p>
                                    <p>United States</p> --}}
                                </div>
                            </td>
                            <td class="w-1/2 align-top text-right">
                                <div class="text-sm text-neutral-600">
                                    <p class="font-bold">{{ $salesOrder->customer?->name }}</p>
                                    <p>Number: 123456789</p>
                                    <p>VAT: 23456789</p>
                                    <p>9552 Vandervort Spurs</p>
                                    <p><strong>Phone:</strong> {{ $salesOrder->customer?->phone }}</p>
                                    <p><strong>Phone:</strong> {{ $salesOrder->customer?->email }}</p>
                                    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-14 py-10 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <thead>
                        <tr>
                            <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">No</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Product</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Price</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Qty.</td>                            
                            <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main p-3">Subtotal</td>
               
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($salesOrder->salesOrderItems as $index => $item)
                            <tr>
                                <td class="border-b py-3 pl-3">{{ $index + 1 }}</td>
                                <td class="border-b py-3 pl-2">{{ $item?->inventory?->product?->name }}</td>
                                <td class="border-b py-3 pl-2 text-right"> {{ format_money($item->unit_price) }}</td>
                                <td class="border-b py-3 pl-2 text-center"> {{ $item->quantity }}</td>                                                                
                                <td class="border-b py-3 pl-2 text-right p-3"> {{ format_money($item->unit_price* $item->quantity) }}</td>                                
                            </tr>                            
                        @endforeach
                      
                        <tr>
                            <td colspan="5">
                                <table class="w-full border-collapse border-spacing-0">
                                    <tbody>
                                        <tr>
                                            <td class="w-full"></td>
                                            <td>
                                                <table class="w-full border-collapse border-spacing-0">
                                                    <tbody>
                                                  
                                                        @if($salesOrder->taxes)
                                                            <tr>
                                                                <td class="border-b p-3">
                                                                    <div class="whitespace-nowrap text-slate-400">Taxes:
                                                                    </div>
                                                                </td>
                                                                <td class="border-b p-3 text-right">
                                                                    <div class="whitespace-nowrap font-bold text-main">
                                                                    {{  format_money($salesOrder->taxes) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if($salesOrder->miscellaneous)
                                                            <tr>
                                                                <td class="border-b p-3">
                                                                    <div class="whitespace-nowrap text-slate-400">Miscellaneous:
                                                                    </div>
                                                                </td>
                                                                <td class="border-b p-3 text-right">
                                                                    <div class="whitespace-nowrap font-bold text-main">
                                                                    {{  format_money($salesOrder->miscellaneous) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if($salesOrder->freight)
                                                            <tr>
                                                                <td class="border-b p-3">
                                                                    <div class="whitespace-nowrap text-slate-400">Freight:
                                                                    </div>
                                                                </td>
                                                                <td class="border-b p-3 text-right">
                                                                    <div class="whitespace-nowrap font-bold text-main">
                                                                    {{  format_money($salesOrder->freight) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if($salesOrder->discount)
                                                            <tr>
                                                                <td class="border-b p-3">
                                                                    <div class="whitespace-nowrap text-slate-400">Discount:
                                                                    </div>
                                                                </td>
                                                                <td class="border-b p-3 text-right">
                                                                    <div class="whitespace-nowrap font-bold text-main">
                                                                    {{  format_money($salesOrder->discount) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                       
                                                        @if($salesOrder->order_total)
                                                           <tr>
                                                                <td class="bg-main p-3">
                                                                    <div class="whitespace-nowrap font-bold text-white">
                                                                        Total:</div>
                                                                </td>
                                                                <td class="bg-main p-3 text-right">
                                                                    <div class="whitespace-nowrap font-bold text-white">
                                                                    {{ format_money($salesOrder->order_total) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif       
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- <div class="px-14 text-sm text-neutral-700">
                <p class="text-main font-bold">PAYMENT DETAILS</p>
                <p>Banks of Banks</p>
                <p>Bank/Sort Code: 1234567</p>
                <p>Account Number: 123456678</p>
                <p>Payment Reference: BRA-00335</p>
            </div> --}}

            <div class="px-14 py-10 text-sm text-neutral-700">
                <p class="text-main font-bold">Notes</p>
                <p class="italic"> {{ $salesOrder->notes }}</p>
                 {{-- </dvi>  --}}

                {{-- <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
                    Supplier Company
                    <span class="text-slate-300 px-2">|</span>
                    info@company.com
                    <span class="text-slate-300 px-2">|</span>
                    +1-202-555-0106
                </footer> --}}
            </div>
        </div>
</body>

</html>