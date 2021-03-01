<thead>
    <tr role="row">
        @foreach($columns as $column)
            <th {{ $column->hasCustomWidth() ? 'style=width:'.$column->getWidth().';' : '' }}>
                {{ $column->getDisplayName() }}
            </th>
        @endforeach
    </tr>
</thead>
