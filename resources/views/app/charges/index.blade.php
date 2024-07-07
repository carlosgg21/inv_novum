@extends('layouts.app')
@section('title', 'Charges')
@section('page-title', 'Charge List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Charge List"></x-breadcrumb>
<x-new-record route="charges.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}" class="form-control form-control-sm" autocomplete="off" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info-t btn-sm">
                                <i class="ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.charges.index_title')</h4>
            </div> --}}

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                    <thead style="background-color: #00B88B; color: white" >
                        <tr>
                            <th class="text-left">
                                @lang('crud.charges.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.charges.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($charges as $charge)
                        <tr>
                            <td>{{ $charge->name ?? '-' }}</td>
                            <td>{{ $charge->description ?? '-' }}</td>
                            <td class="text-center" style="width: 134px">
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                    @can('update', $charge)
                                    <a href="{{ route('charges.edit', $charge) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon-note"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $charge)
                                    <a href="{{ route('charges.show', $charge) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="ti-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $charge)
                                    <form action="{{ route('charges.destroy', $charge) }}" method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{!! $charges->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection