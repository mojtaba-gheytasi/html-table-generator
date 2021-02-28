<?php

namespace App\Http\Controllers;

use App\Services\HtmlTableGenerator\Tables\UserTable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = (new UserTable($request))->getResult();

        return view('table-generator.main', compact('data'));
    }
}
