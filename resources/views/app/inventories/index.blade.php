@extends('layouts.app')
@section('title', 'Inventory')
@section('page-title', 'Inventory List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Inventory List"></x-breadcrumb>
<x-new-record route="inventories.create"></x-new-record>

@endsection
@section('content')
<div class="card">
        <div class="card-body">
    
            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                    <thead class="table-heard">
                        <tr>
                            <th> </th>
                            <th class="text-left"> Code</th>
                            <th class="text-left"> Name</th>
                            <th class="text-left"> Category</th>
                            <th class="text-left"> Brand</th>
                            <th class="text-center"> Qty </th>
                            <th class="text-right"> Unit Price</th>
                            <th class="text-right"> Total Price</th>
                            <th class="text-right"> Cost Price</th>
                            <th class="text-right"> Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventories as $key=>$inventory)
                      
                        <tr data-toggle="collapse" data-target="#{{ $key }}" class="accordion-toggle">
                            <td><button class="btn btn-default btn-xs"><span class="fas fa-angle-right"></span></button>
                            </td>
                            <td>

                                <a href="{{ route('products.index', ['search' => $inventory['product']->code]) }}" target="_blank">
                                    {{ $inventory['product']->code ?? '-' }}
                                </a>
                            </td>
                            <td>{{ $inventory['product']->name ?? '-' }}</td>
                            <td>{{ optional($inventory['product']->category)->name ?? '-' }}</td>
                            <td>{{ optional($inventory['product']->brand)->name ?? '-' }}</td>
                            <td class="text-center">{{ $inventory['product']->qty ?? 0 }}</td>
                            <td class="text-right">{{ $inventory['product']->unit_price ?? 0 }}</td>
                            <td class="text-right">{{  format_money($inventory['product']->total_price, setting('global.company_currency') )}}</td>
                            <td class="text-right">{{ $inventory['product']->cost_price ?? 0 }}</td>
                            <td class="text-right">{{  format_money($inventory['product']->total_cost, setting('global.company_currency') )}}</td>
                    
                        </tr>
    
                        <tr>
                            <td colspan="11" class="hiddenRow">
                                <div id="{{ $key }}" class="accordian-body collapse collapsed-content">
    
                                    <table class="table table-boder table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Supplier</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Cost Price</th>
                                    
                                                <th scope="col">Batch Number</th>
                                                <th scope="col">Expire Date</th>
                                      
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($inventory['inventories'] as $details)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ optional($details->supplier)->name ?? '-' }}</td>
                                                <td>{{ optional($details->location)->name ?? '-' }}</td>
                                                <td>{{ $details->quantity ?? 0 }}</td>
                                                <td>{{ $details->sell_price ?? 0 }}</td>
                                                <td>{{ $details->cost_price ?? 0 }}</td>
                                                <td>{{ $details->batch_number ?? '-' }}</td>
    
                                                <td>{{ $details->expire_date ? format_date($details->expire_date, 'd/m/y') :
                                                    '-' }}</td>
                                       
                                            </tr>
                                            @endforeach
    
                                        </tbody>
                                    </table>
    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
    
                </table>
            </div>
    
        </div>
    </div>
@endsection
@section('css')
<style>
    .collapsed-content {
        background-color: #f9f9f9;
        border-left: 4px solid #009973;

        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }



    .collapsed-content thead {
        background-color: #f0f0f0;
    }



    .accordian-body {
        transition: all 0.3s ease;
    }

    .accordion-toggle {
        cursor: pointer;
    }

    .hiddenRow {
        padding: 0 !important;
    }
</style>
@endsection
@section('js')
<script>
    $(document).ready(function() {
    $('.accordion-toggle').on('click', function() {
    var target = $(this).data('target');
    var icon = $(this).find('.fas');
    
    $(target).on('show.bs.collapse', function() {
    icon.removeClass('fa-angle-right').addClass('fa-angle-down');
    });
    
    $(target).on('hide.bs.collapse', function() {
    icon.removeClass('fa-angle-down').addClass('fa-angle-right');
    });
    
    // Trigger the click event on the button to toggle the collapse
    $(target).collapse('toggle');
    });
    });
</script>
@endsection