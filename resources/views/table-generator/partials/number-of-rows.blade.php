<div class="dataTables_length" id="example_length">
    <label>
        Show
        <div class="dropdown bootstrap-select">
            <select name="rowPerPage" class="queryChanged" id="rowPerPage">
                @if(request()->has('rowPerPage'))
                    @foreach(config('html-table-generator.rowPerPage') as $value)
                        <option value="{{ $value }}" {{ request()->get('rowPerPage') == $value ? "selected" : "" }}>
                            {{ $value }}
                        </option>
                    @endforeach
                @else
                    @foreach(config('html-table-generator.rowPerPage') as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        entries
    </label>
</div>
