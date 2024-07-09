@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Invoice::class)
                <a
                    href="{{ route('invoices.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.invoices.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.sales_order_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.number')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.status')
                            </th>
                            <th class="text-right">
                                @lang('crud.invoices.inputs.total_amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.employee_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.currency_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.year')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.mount')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.notes')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>
                                {{ optional($invoice->salesOrder)->number ?? '-'
                                }}
                            </td>
                            <td>{{ $invoice->number ?? '-' }}</td>
                            <td>{{ $invoice->date ?? '-' }}</td>
                            <td>{{ $invoice->status ?? '-' }}</td>
                            <td>{{ $invoice->total_amount ?? '-' }}</td>
                            <td>
                                {{ optional($invoice->employee)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($invoice->currency)->name ?? '-' }}
                            </td>
                            <td>{{ $invoice->year ?? '-' }}</td>
                            <td>{{ $invoice->mount ?? '-' }}</td>
                            <td>{{ $invoice->notes ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $invoice)
                                    <a
                                        href="{{ route('invoices.edit', $invoice) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $invoice)
                                    <a
                                        href="{{ route('invoices.show', $invoice) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $invoice)
                                    <form
                                        action="{{ route('invoices.destroy', $invoice) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11">{!! $invoices->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
