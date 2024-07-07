@props(['model', 'routeName' => null])
@php
$route = $routeName ?? $model->getTable();
@endphp
<td class="cell-center" style="width: 20px">
    <div class="dropdown">
        <span class="cell-center" type="button" id="{{ $model->id }}_dropdownMenu" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="icon-options-vertical "></i>
        </span>
        <div class="dropdown-menu" aria-labelledby="{{ $model->id }}_dropdownMenu">
            @can('update', $model)
            <a class="dropdown-item" href="{{ route($route. '.edit', $model->id) }}">
                <i class="ti-pencil-alt text-success"></i> Edit
            </a>
            @endcan
            @can('view', $model)
            <a class="dropdown-item" href="{{ route($route. '.show', $model->id) }}">
                <i class="icon-eye"></i> Show
            </a>
            @endcan
            @can('delete', $model)
            <form action="{{ route($route. '.destroy', $model->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item btn btn-link btn-sm text-danger">
                    <i class="fa fa-trash fa-fw" title="Delete" aria-hidden="true"></i> Delete
                </button>
            </form>
            @endcan
        </div>
    </div>
</td>