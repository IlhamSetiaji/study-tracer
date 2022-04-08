<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $study = Study::all()->count();
        return view('siswa.siswa',compact('study'));
    }

    public function showAllStudies()
    {
        $studies = Study::all();
        return view('siswa.study',compact('studies'));
    }
}
