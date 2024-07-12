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
                @can('create', App\Models\Contact::class)
                <a
                    href="{{ route('contacts.create') }}"
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
                <h4 class="card-title">@lang('crud.contacts.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.identification')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.last_name')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.phone')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.email')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.address')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.zip_code')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.default')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.country_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.city_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.contacts.inputs.township_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->identification ?? '-' }}</td>
                            <td>{{ $contact->name ?? '-' }}</td>
                            <td>{{ $contact->last_name ?? '-' }}</td>
                            <td>{{ $contact->phone ?? '-' }}</td>
                            <td>{{ $contact->email ?? '-' }}</td>
                            <td>{{ $contact->address ?? '-' }}</td>
                            <td>{{ $contact->zip_code ?? '-' }}</td>
                            <td>{{ $contact->default ?? '-' }}</td>
                            <td>
                                {{ optional($contact->country)->name ?? '-' }}
                            </td>
                            <td>{{ optional($contact->city)->name ?? '-' }}</td>
                            <td>
                                {{ optional($contact->township)->name ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $contact)
                                    <a
                                        href="{{ route('contacts.edit', $contact) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $contact)
                                    <a
                                        href="{{ route('contacts.show', $contact) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $contact)
                                    <form
                                        action="{{ route('contacts.destroy', $contact) }}"
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
                            <td colspan="12">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">{!! $contacts->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
