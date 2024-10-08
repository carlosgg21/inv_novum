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
                @can('create', App\Models\Address::class)
                <a
                    href="{{ route('addresses.create') }}"
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
                <h4 class="card-title">@lang('crud.addresses.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.address')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.zip_code')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.country_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.addressable_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.city_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.addressable_type')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.township_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.zip_code')
                            </th>
                            <th class="text-left">
                                @lang('crud.addresses.inputs.default')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($addresses as $address)
                        <tr>
                            <td>{{ $address->address ?? '-' }}</td>
                            <td>{{ $address->zip_code ?? '-' }}</td>
                            <td>
                                {{ optional($address->country)->name ?? '-' }}
                            </td>
                            <td>{{ $address->addressable_id ?? '-' }}</td>
                            <td>{{ optional($address->city)->name ?? '-' }}</td>
                            <td>{{ $address->addressable_type ?? '-' }}</td>
                            <td>
                                {{ optional($address->township)->name ?? '-' }}
                            </td>
                            <td>{{ $address->zip_code ?? '-' }}</td>
                            <td>{{ $address->default ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $address)
                                    <a
                                        href="{{ route('addresses.edit', $address) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $address)
                                    <a
                                        href="{{ route('addresses.show', $address) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $address)
                                    <form
                                        action="{{ route('addresses.destroy', $address) }}"
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
                            <td colspan="10">{!! $addresses->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
