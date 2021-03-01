<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HtmlTableGenerator\HtmlTableGenerator;
use App\Services\HtmlTableGenerator\Tables\UserTable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HtmlTableGenerator;

    public function users(Request $request)
    {
        return $this->generateHtmlTable(new UserTable($request));
    }

    public function employees(Request $request)
    {
        return $this->generateHtmlTable(new UserTable($request));
    }

}
