<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function index()
    {
        // $user = Auth::user();
        // // dd($user);

        //  if ($user->role =='admin'){
        //      return view('admin.layouts.home');
        //  }else if($user->role =='teacher'){
        //     return view('admin.teacher.home');
        // }
        //  else if($user->role =='student'){
        //      dd('student');
        //  }

        return view('admin.layouts.home');

        
    }
    
}
