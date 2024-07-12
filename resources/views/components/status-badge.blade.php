@props(['status'])

<td>
    @if ($status == 'Active')
    <span class="badge  badge-pill badge-primary">Activo</span>
    @elseif ($status == 'Inactive')
    <span class="badge  badge-pill badge-danger">Inactivo</span>
    @else
    <span class="badge badge-pill badge-dark">-</span>
    @endif
</td>