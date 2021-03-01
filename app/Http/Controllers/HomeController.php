<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HtmlTableGenerator\HtmlTableGenerator;
use App\Services\HtmlTableGenerator\Tables\CompanyTable;
use App\Services\HtmlTableGenerator\Tables\EmployeeTable;
use App\Services\HtmlTableGenerator\Tables\UserTable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HtmlTableGenerator;


    public function users(Request $request)
    {
        return $this->generateHtmlTable(new UserTable($request));
    }


    public function employees(Request $request)
    {
        return $this->generateHtmlTable(new EmployeeTable($request));
    }


    public function companies(Request $request)
    {
        return $this->generateHtmlTable(new CompanyTable($request));
    }

}
