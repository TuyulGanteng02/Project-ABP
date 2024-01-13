<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index() {
        return view('sesi/index');
    }

    function login(Request $request) {
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ], [
            'email.required'=>'Email harus diisi',
            'password.required'=>'Password harus diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('buku')->with('success', Auth::user()->name.(' berhasil Login'));
        } else {
            return redirect('sesi')->withErrors('Email dan Password tidak valid');
        }
    }

    function logout() {
        Auth::logout();
        return redirect('sesi')->with('success','Berhasil Logout');
    }

    function register() {
        return view('sesi/register');
    }

    function create(Request $request) {
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ], [
            'name.required'=>'Nama harus diisi',
            'email.required'=>'Email harus diisi',
            'email.email'=>'Masukkan email yang valid',
            'email.unique'=>'Email sudah ada',
            'password.required'=>'Password harus diisi',
            'password.min'=>'Minimum password 8 karakter',
        ]);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];
        User::create($data);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('buku')->with('success', Auth::user()->name.(' berhasil Login'));
        } else {
            return redirect('sesi')->withErrors('Email dan Password tidak valid');
        }
    }
}
