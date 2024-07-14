@php
    $statuses = [
        'open'      => ['class' => 'badge-secondary', 'label' => 'Open'],
        'accepted'  => ['class' => 'badge-primary', 'label' => 'Accepted'],
        'paid'      => ['class' => 'badge-success', 'label' => 'Paid'],
        'closed'    => ['class' => 'badge-black', 'label' => 'Closed'],
        'cancelled' => ['class' => 'badge-danger', 'label' => 'Cancelled'],
    ];

    $statusClass = $statuses[$status]['class'] ?? 'badge-secondary';
    $statusLabel = $statuses[$status]['label'] ?? 'Unknown';
@endphp

<td style="text-align: center; vertical-align: middle;">
    <span class="badge badge-pill {{ $statusClass }}">
        {{ $statusLabel }}
    </span>
</td>