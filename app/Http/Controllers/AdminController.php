<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function showAllAccounts()
    {
        $users = User::whereHas('roles', function($query){
            $query->where('name','!=','admin');
        })->get();
        return view('admin.akun', compact('users'));
    }
}
