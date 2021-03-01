<table class="display dataTable no-footer" style="min-width: 845px" role="grid">
    @include('table-generator.partials.thead', ['columns' => $data['columns']])
    @include('table-generator.partials.tbody', [
                'columns' => $data['columns'],
                'collection' => $data['paginator']->getCollection()])
</table>
@include('table-generator.partials.info', ['paginator' => $data['paginator']])

{{ $data['paginator']->links('table-generator.partials.pagination') }}
