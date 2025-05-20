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
        $siswa = Siswa::where('user_id', $user->id)->first();

        $biodataComplete = false;
        $berkasComplete = false;
        $isComplete = false;

        if ($siswa) {
            $biodataComplete = $siswa->isBiodataComplete();
            $berkasComplete = $siswa->isBerkasComplete();
            $nilaiComplete = $siswa->isNilaiComplete();
            $isComplete = $siswa->checkAndUpdateCompleteStatus(); // sekaligus update ke DB
        }

        return view('dashboard', compact('siswa', 'biodataComplete', 'berkasComplete', 'nilaiComplete', 'isComplete'));
    }
}
