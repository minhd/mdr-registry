<?php

namespace App\Http\Controllers;

use App\Registry\Models\Record;
use Illuminate\Http\Request;

class PortalHomeController extends Controller
{
    public function index()
    {
        $records = Record::all();
        return view('welcome', ['records' => $records]);
    }

    public function view($id)
    {
        $record = Record::find($id);
        return view('record', ['record' => $record]);
    }
}
