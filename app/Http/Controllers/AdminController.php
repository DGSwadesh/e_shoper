<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function index()
    {
        // return view('admin.admin_layout');
        return view('admin_login');
    }

    // public function show_dashboard()
    // {
    //     return view('admin.dashboard');
    //     // return view('admin.admin_login');
    // }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_pass = md5($request->admin_pass);

        $result = DB::table('tbl_admin')
        ->where('admin_email', $admin_email)
        ->where('admin_password', $admin_pass)
        ->first();
        if($result){
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id', $result->admin_id);
            return redirect('/dashboard');
        }else{
            $request->session()->put('message', 'Email or password is invalid');
            return redirect('/admin');
        }
        // dd($result);
        // echo $admin_pass;

        // $user_email = $request->admin_email;
    }
}
