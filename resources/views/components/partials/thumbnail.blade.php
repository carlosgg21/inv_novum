@props([
'src',
'size' => 50,
'alt' => 'Logo'
])

<div class="d-flex justify-content-center align-items-center border rounded"
    style="width: {{ $size }}px; height: {{ $size }}px; overflow: hidden;">
    @if($src)
    <img src="{{ $src }}" alt="{{ $alt }}" class="img-fluid"
        style="object-fit: contain; max-width: 100%; max-height: 100%;">
    @else
    <span class="text-muted">No logo</span>
    @endif
</div>