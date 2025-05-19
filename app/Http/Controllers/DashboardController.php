<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data siswa berdasarkan email user
        $siswa = Siswa::where('email', $user->email)->first();

        $isComplete = false;

        if ($siswa) {
            $isComplete = $siswa->isComplete();
        }

        return view('dashboard', compact('siswa', 'isComplete'));
    }
}
