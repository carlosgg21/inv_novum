@props(['model', 'routePrefix','module'=>null])

<td class="text-center" style="width: 134px;">
    <div role="group" aria-label="Row Actions" class="btn-group">
        @can('update', $model)
        <a href="{{ route($routePrefix . '.edit', $model) }}">
            <button type="button" class="btn btn-light">
                <i class="icon-note"></i>
            </button>
        </a>
        @endcan
        @can('view', $model)
        <a href="{{ route($routePrefix . '.show', $model) }}">
            <button type="button" class="btn btn-light">
                <i class="ti-eye"></i>
            </button>
        </a>
        @endcan
        @can('delete', $model)
        <form action="{{ route($routePrefix . '.destroy', $model) }}" method="POST"
            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-light text-danger">
                <i class="ti-trash"></i>
            </button>
        </form>
        @endcan

        @if($module === 'sales-order')
        <a href="#">
            <button type="button" class="btn btn-light">
    <i class="fab fa-wpforms"></i>
            </button>
        </a>
        @endif
    </div>
    
</td>