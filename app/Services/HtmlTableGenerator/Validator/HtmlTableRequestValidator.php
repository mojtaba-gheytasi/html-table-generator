<?php

namespace App\Services\HtmlTableGenerator\Validator;

use App\Services\HtmlTableGenerator\HtmlTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HtmlTableRequestValidator
{
    public function validate(Request $request, HtmlTable $htmlTable)
    {
        $rowPerPageOptions = $this->getLinkedRowPerPageOptions();

        $sortableColumnNames = $this->getLinkedSortableColumnNames($htmlTable);

        $validator = Validator::make($request->all(), [
            'page' => 'nullable|integer|min:1',
            'searchTerm' => 'nullable|string|min:3',
            'rowPerPage' => 'nullable|integer|in:' . $rowPerPageOptions,
            'sortBy' => 'nullable|string|in:' . $sortableColumnNames,
            'sortDirection' => 'nullable|string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            abort(404);
        }
    }

    private function getLinkedSortableColumnNames(HtmlTable $htmlTable) : string
    {
        $columns = array_map(function ($column) {
            return $column->getName();
        }, $htmlTable->getSortableColumns());

        return implode(',', array_unique($columns));
    }

    private function getLinkedRowPerPageOptions() : string
    {
        return implode(',', config('html-table-generator.rowPerPage'));
    }
}
