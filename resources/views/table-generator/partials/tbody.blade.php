<tbody>
@foreach($collection as $row)
    <tr class="odd" role="row">
        @foreach($columns as $column)
            <td {{ $column->hasCustomWidth() ? 'style=width:'.$column->getWidth().';' : '' }}>
                {{ $row->{$column->getDisplayName()} }}
            </td>
        @endforeach
    </tr>
@endforeach
</tbody>
