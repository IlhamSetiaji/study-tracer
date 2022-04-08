<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Notifikasi;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Ternary;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin()
    {
        $validator = Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8|string',
        ]);
        if($validator->fails())
        {
            return redirect('login')->withInput()->withErrors($validator);
        }

        $user = User::where('email', request()->email)->first();
        if($user)
        {
            if(Hash::check(request()->password, $user->password))
            {
                if($user->status == 'ACTIVE')
                {
                    if($user->hasRole('admin'))
                    {
                        Auth::login($user);
                        return redirect('/admin');
                    }
                    elseif($user->hasRole('guru'))
                    {
                        Auth::login($user);
                        return redirect('/guru');
                    }
                    elseif($user->hasRole('siswa'))
                    {
                        Auth::login($user);
                        return redirect('/');
                    }
                }
                return redirect('login')->with('status','User belum aktif');
            }
            return redirect('login')->with('status','Password anda salah');
        }
        return redirect('login')->with('status','Email tidak ditemukan');
    }

    public function logout()
    {
        $user = request()->user();
        Auth::logout($user);
        return redirect('login');
    }

    public function register()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function storeRegister()
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required_with:password-confirm|same:password-confirm|min:8',
            'password-confirm' => 'min:8',
        ]);
        if($validator->fails())
        {
            return redirect('/admin/register')->withInput()->withErrors($validator);
        }

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        $user->assignRole(request()->roles);
        Mail::to($user->email)->send(new Notifikasi($user->email, 'Hallo untuk user dengan nama "'.$user->name.'". Selamat akun anda telah dibuat, silahkan untuk konfirmasi ke admin'));
        return redirect('/admin/account')->with('status','Registrasi akun berhasil');
    }

    public function updateAccount($userID)
    {
        $user = User::find($userID);
        $validator = Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required_with:password-confirm|same:password-confirm|min:8',
            'password-confirm' => 'min:8',
            'status' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect('/admin/register')->withInput()->withErrors($validator);
        }
        $user->update([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        return redirect('/admin/account')->with('status','Update akun berhasil');
    }
    
    public function updateAccountStatus($userID)
    {
        $user = User::find($userID);

        $user->status == 'ACTIVE' ? $user->update(['status' => 'INACTIVE']) : $user->update(['status' => 'ACTIVE']);
        Mail::to($user->email)->send(new Notifikasi($user->email, 'Hallo untuk user dengan nama "'.$user->name.'". Selamat akun anda telah diaktifkan, silahkan untuk login'));
        return redirect('/admin/account')->with('status','Update akun berhasil');
    }

    public function deleteAccount($userID)
    {
        $user = User::find($userID);
        User::destroy($userID);
        return redirect('/admin/account')->with('status','Delete akun berhasil');
    }
}
