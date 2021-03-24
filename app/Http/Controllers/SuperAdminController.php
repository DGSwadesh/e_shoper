<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SuperAdminController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
        return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect::to('/admin');
    }

    public function AdminAuthCheck()
    {
        $admin_id = Session('admin_id');
        if ($admin_id) {
            return;
        } else {
            return redirect::to('/admin')->send();
        }
    }
}
