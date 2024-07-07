@props(['columns', 'uncheckedColumns'])

@php
// Si no se proporciona uncheckedColumns, se asume que todas las columnas deben estar marcadas
if (!isset($uncheckedColumns)) {
$uncheckedColumns = [];
}
@endphp

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="columnToggleDropdownButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="icon-settings"></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="columnToggleDropdownButton" style="padding-left: 5px">
        @foreach ($columns as $column => $label)
        <div class="form-check">
            <input class="form-check-input column-toggle" type="checkbox" id="check{{ $column }}"
                data-column="{{ $column }}" {{ in_array($column, $uncheckedColumns) ? '' : 'checked' }} />
            <label class="form-check-label" for="check{{ $column }}">{{ $label }}</label>
        </div>
        @endforeach
    </div>
</div>