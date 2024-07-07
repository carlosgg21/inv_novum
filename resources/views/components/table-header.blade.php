<thead class="thead-dark">
    <tr>
   @foreach ($columns as $column => $attributes)
    <th @if (isset($attributes['class'])) class="{{ $attributes['class'] }}" @endif>{{ $attributes['label'] }}</th>
    @endforeach
    </tr>
</thead>