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
                @can('create', App\Models\PaymentMade::class)
                <a
                    href="{{ route('payment-mades.create') }}"
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
                <h4 class="card-title">
                    @lang('crud.payment_mades.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.supplier_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.payment_method_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.payment_term_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.payment_mades.inputs.amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.reference_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.purchase_order_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.created_by')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_mades.inputs.aproved_by')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentMades as $paymentMade)
                        <tr>
                            <td>
                                {{ optional($paymentMade->supplier)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($paymentMade->paymentMethod)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($paymentMade->paymentTerm)->description
                                ?? '-' }}
                            </td>
                            <td>{{ $paymentMade->amount ?? '-' }}</td>
                            <td>{{ $paymentMade->reference_number ?? '-' }}</td>
                            <td>{{ $paymentMade->date ?? '-' }}</td>
                            <td>
                                {{ optional($paymentMade->purchaseOrder)->number
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($paymentMade->employee)->name ?? '-'
                                }}
                            </td>
                            <td>{{ $paymentMade->aproved_by ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $paymentMade)
                                    <a
                                        href="{{ route('payment-mades.edit', $paymentMade) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $paymentMade)
                                    <a
                                        href="{{ route('payment-mades.show', $paymentMade) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $paymentMade)
                                    <form
                                        action="{{ route('payment-mades.destroy', $paymentMade) }}"
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
                            <td colspan="10">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {!! $paymentMades->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
