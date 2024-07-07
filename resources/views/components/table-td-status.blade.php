@props(['statusTrue', 'statusFalse', 'status'])

<td style="text-align: center; vertical-align: middle;">
    <span class="badge {{ $status ? 'badge-success' : 'badge-dark' }}">
        {{ $status ? $statusTrue : $statusFalse }}
    </span>
</td>