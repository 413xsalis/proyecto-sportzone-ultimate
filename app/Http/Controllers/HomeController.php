<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $user = \Auth::user();
    //     if($user->hasRole('admin')){
    //        return redirect('admin/dashboard');
    //     }elseif($user->hasRole('editor')){
    //         return redirect('editor/dashboard');
    //     }
    //     return redirect('/');
    //     //return view('home');
    // }
        public function index()
    {
        $usuario = \Auth::user();
        if($usuario->hasRole('admin')){
           return redirect('admin/dashboard');
        }elseif($usuario->hasRole('colaborador')){
            return redirect('colaborador/dashboard');
        }elseif($usuario->hasRole('instructor')){
            return redirect('instructor/dashboard');
        }
        return redirect('/');
        //return view('home');
    }

}
