<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator;

use App\Services\HtmlTableGenerator\Validator\HtmlTableRequestValidator;

trait HtmlTableGenerator
{
    public function generateHtmlTable(HtmlTable $htmlTable)
    {

        (new HtmlTableRequestValidator)->validate(request(), $htmlTable);

        $data = $htmlTable->getResult();

        if (request()->ajax()) {

            $data = $htmlTable->getResult();

            return view('table-generator.partials.table-data',
                compact('data')
            )->render();
        }

        return view('table-generator.main', compact('data'));
    }
}
