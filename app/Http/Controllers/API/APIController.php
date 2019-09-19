<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    public function index()
    {
        return [
            'status' => 'OK',
            'version' => '0.1'
        ];
    }
}
