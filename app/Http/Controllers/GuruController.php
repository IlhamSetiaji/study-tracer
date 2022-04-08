<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Study;
use App\Mail\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.guru');
    }

    public function daftarStudy()
    {
        $studies = Study::all();
        return view('guru.study', compact('studies'));
    }

    public function storeStudy()
    {
        $user = request()->user();
        if(!$user->hasRole('guru'))
        {
            return redirect('/logout');
        }
        $validator = Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'joined_date' => 'required|date',
            'graduate_date' => 'required|date|after:joined_date',
            'address' => 'required|string',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);
        if($validator->fails())
        {
            return redirect('/guru/study')->withInput()->withErrors($validator);
        }

        $study=Study::create([
            'name' => request()->name,
            'university' => request()->university,
            'joined_date' => request()->joined_date,
            'graduate_date' => request()->graduate_date,
            'address' => request()->address,
            'fakultas' => request()->fakultas,
            'jurusan' => request()->jurusan,
        ]);
        $users = User::role('siswa')->get();
        foreach($users as $u)
        {
            Mail::to($u->email)->send(new Notifikasi($u->email, 'Guru telah membuat study tracer untuk siswa dengan nama "'.$study->name.'" yang berkuliah di "'.$study->university.'"'));
        }
        return redirect('guru/study')->with('status','Data study berhasil dibuat');
    }

    public function updateStudy($studyID)
    {
        $user = request()->user();
        if(!$user->hasRole('guru'))
        {
            return redirect('/logout');
        }

        $study = Study::find($studyID);
        if(!$study)
        {
            return redirect('guru/study')->with('status','Data study tidak ditemukan');
        }

        $validator = Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'joined_date' => 'required|date',
            'graduate_date' => 'required|date|after:joined_date',
            'address' => 'required|string',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);
        if($validator->fails())
        {
            return redirect('/guru/study')->withInput()->withErrors($validator);
        }

        $study->update([
            'name' => request()->name,
            'university' => request()->university,
            'joined_date' => request()->joined_date,
            'graduate_date' => request()->graduate_date,
            'address' => request()->address,
            'fakultas' => request()->fakultas,
            'jurusan' => request()->jurusan,
        ]);
        return redirect('guru/study')->with('status','Data study berhasil diupdate');
    }

    public function deleteStudy($studyID)
    {
        $user = request()->user();
        if(!$user->hasRole('guru'))
        {
            return redirect('/logout');
        }

        $study = Study::find($studyID);
        if(!$study)
        {
            return redirect('guru/study')->with('status','Data study tidak ditemukan');
        }

        Study::destroy($studyID);
        return redirect('guru/study')->with('status','Data study berhasil dihapus');
    }
}
