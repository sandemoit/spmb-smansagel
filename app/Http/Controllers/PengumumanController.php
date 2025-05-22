<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('page.pengumuman.index');
    }

    public function show()
    {
        return view('page.pengumuman.hasil');
    }
}
