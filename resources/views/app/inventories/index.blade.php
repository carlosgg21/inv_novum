@extends('layouts.app')
@section('title', 'Inventory')
@section('page-title', 'Inventory List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Inventory List"></x-breadcrumb>
<x-new-record route="inventories.create"></x-new-record>

@endsection
@section('content')
<div class="container">


    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
             <table class="table table-borderless table-hover table-sm table-striped">
                <thead class="table-heard">
                        <tr>
                            <th > </th>
                            <th class="text-left"> Code</th>
                            <th class="text-left"> Name</th>
                            <th class="text-left"> Category</th>
                            <th class="text-left"> Brand</th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> On Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventories as $inventory)
                  
                            <tr data-toggle="collapse" data-target="#{{ $inventory->code }}" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><span class="fas fa-angle-right"></span></button></td>
                           
                                    <td>{{ $inventory->code ?? '-' }}</td>
                                    <td>{{ $inventory->name ?? '-' }}</td>
                                    <td>{{ optional($inventory->category)->name ?? '-' }}</td>
                                    <td>{{ optional($inventory->brand)->name ?? '-' }}</td>
                                    <td>{{ $inventory->qty ?? 0 }}</td>
                                    <td>{{ $inventory->on_order ?? 0 }}</td>

                                    <tr>
                                        <td colspan="7" class="hiddenRow">
                                       <div id="{{ $inventory->code }}" class="accordian-body collapse collapsed-content">
                                                
                                                <table class="table table-boder table-sm">
                                                       <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Supplier</th>
                                                            <th scope="col">Location</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">On Qty</th>
                                                            {{-- <th scope="col">Expire Date</th> --}}
                                                            <th class="text-rigth" scope="col">Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($inventory->inventories as $details)
                                                        <tr>
                                                            <th scope="row">{{ $loop->index+1 }}</th>                                                    
                                                             <td>{{ optional($details->supplier)->name ?? '-' }}</td>
                                                             <td>{{ optional($details->location)->name ?? '-' }}</td>
                                                             <td>{{ $details->quantity ?? 0 }}</td>
                                                             <td>{{ $details->quantity_on_order ?? 0 }}</td>
                                                     
                                                             <td class="text-rigth">$ 22.00</td>
                                                     
                                                        </tr>
                                                      @endforeach
                                                     
                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                            {{-- <td>
                                {{ optional($inventory->supplier)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($inventory->product)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($inventory->location)->name ?? '-'
                                }}
                            </td>
                            <td>{{ $inventory->quantity ?? '-' }}</td>
                            <td>{{ $inventory->min_qty ?? '-' }}</td>
                            <td>{{ $inventory->max_qty ?? '-' }}</td>
                            <td>{{ $inventory->quantity_on_order ?? '-' }}</td>
                          
                        </tr> --}}
                        @empty
                        <tr>
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <td colspan="8">{!! $inventories->render() !!}</td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $inventories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    
    .collapsed-content {
    background-color: #f9f9f9;
    border-left: 4px solid #009973;
  
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
    console.log('dsds')
    
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