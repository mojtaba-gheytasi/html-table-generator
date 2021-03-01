<div class="dataTables_length" style="margin-left: 100px">
    <label>Sort by:</label>
    <div class="dropdown bootstrap-select">
        <select name="sortBy" class="queryChanged" id="sortBy">
            @if(request()->has('sortBy'))
                @foreach($columns as $column)
                    <option value="{{ $column->getName() }}" {{ request()->get('sortBy') == $column->getName() ? "selected" : "" }}>
                        {{ $column->getDisplayName() }}
                    </option>
                @endforeach
            @else
                @foreach($columns as $column)
                    <option value="{{ $column->getName() }}">
                        {{ $column->getDisplayName() }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="dropdown bootstrap-select">
        <select name="sortDirection" class="queryChanged"  id="sortDirection">
            @php($sortDirections = ['asc' => 'Ascending', 'desc' => 'Descending'])
            @if(request()->has('sortBy'))
                @foreach($sortDirections as $key => $text)
                    <option value="{{ $key }}">{{ $text }}</option>
                @endforeach
            @else
                @foreach($sortDirections as $key => $text)
                    <option value="{{ $key }}">{{ $text }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
