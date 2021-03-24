<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redis;
use DB;
use Illuminate\Support\Facades\Redirect;

class ManufactureController extends Controller
{
    public function addManufacture()
    {
        return view('admin.add_matufacture');
    }

    public function allManufacture()
    {
        $all_manaufacture_info = DB::table('tbl_manaufacture')->get();

        $manage_manaufacture = view('admin.all_matufacture')
            ->with('all_manaufacture_info', $all_manaufacture_info);
        return $manage_manaufacture;
        // return view('admin_layout')->with('admin.all_category',$manage_category);
    }

    public function saveManufacture(Request $request)
    {
        $data = array();
        $data['manaufacture_id'] = $request->manaufacture_id;
        $data['manaufacture_name'] = $request->manaufacture_name;
        $data['manaufacture_description'] = $request->manaufacture_description;
        $data['publication_status'] = $request->publication_status == null ? 0 : 1;
        // dd($data);
        DB::table('tbl_manaufacture')->insert($data);
        $request->session()->put('message', 'Manufacture added successfully');
        return Redirect::to('/addManufacture');
    }

    public function active_unactive_manufacture($manaufacture_id, $manaufacture_status)
    {
        if ($manaufacture_status == 1) {
            DB::table('tbl_manaufacture')
                ->where('manaufacture_id', $manaufacture_id)
                ->update(['publication_status' => 0]);
            session(['message' => 'manaufacture inactivate']);
        } else {
            DB::table('tbl_manaufacture')
                ->where('manaufacture_id', $manaufacture_id)
                ->update(['publication_status' => 1]);
            session(['message' => 'manaufacture activate']);
        }
        return Redirect::to('/allManufacture');
    }

    public function edit_manufacture($manaufacture_id)
    {
        $manaufacture_info = DB::table('tbl_manaufacture')
        ->where('manaufacture_id',$manaufacture_id)
        ->first();
        return view('admin.edit_manaufacture')->with('manaufacture_info',$manaufacture_info);
    }

    public function update_manufacture(Request $request,$manaufacture_id)
    {
        $manaufacture_name = $request->manaufacture_name;
        $manaufacture_description = $request->manaufacture_description;
        DB::table('tbl_manaufacture')
        ->where('manaufacture_id',$manaufacture_id)
        ->update(['manaufacture_name'=> $manaufacture_name,'manaufacture_description'=> $manaufacture_description]);
        session(['message' => 'Manufacture updated successfully']);
        return Redirect::to('/allManufacture');
    }

    public function delete_manufacture($manaufacture_id)
    {
        DB::table('tbl_manaufacture')->where('manaufacture_id',$manaufacture_id)
        ->delete();
        session(['message' => 'manaufacture deleted successfully']);
        return Redirect::to('/allManufacture');
    }
}
