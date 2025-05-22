<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilteringController extends Controller
{
    public function index()
    {
        return view('admin.filtering.index');
    }
}
