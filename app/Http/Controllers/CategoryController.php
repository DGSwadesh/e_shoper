<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.add_category');
    }

    public function allCategory()
    {
        $this->AdminAuthCheck();
        $all_category_info = DB::table('tbl_category')->get();

        $manage_category = view('admin.all_category')
            ->with('all_category_info', $all_category_info);
        return $manage_category;
        // return view('admin_layout')->with('admin.all_category',$manage_category);
    }

    public function saveCategory(Request $request)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status == null ? 0 : 1;
        // dd($data);
        DB::table('tbl_category')->insert($data);
        $request->session()->put('message', 'category added successfully');
        return Redirect::to('/addCategory');
    }

    public function active_unactive_category($category_id, $category_status)
    {
        if ($category_status == 1) {
            DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->update(['publication_status' => 0]);
            session(['message' => 'category inactivate']);
        } else {
            DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->update(['publication_status' => 1]);
            session(['message' => 'category activate']);
        }
        return Redirect::to('/allCategory');
    }

    public function edit_category($category_id)
    {
        $category_info = DB::table('tbl_category')
        ->where('category_id',$category_id)
        ->first();
        return view('admin.edit_category')->with('category_info',$category_info);
    }

    public function update_category(Request $request,$category_id)
    {
        $category_name = $request->category_name;
        $category_description = $request->category_description;
        DB::table('tbl_category')
        ->where('category_id',$category_id)
        ->update(['category_name'=> $category_name,'category_description'=> $category_description]);
        session(['message' => 'category updated successfully']);
        return Redirect::to('/allCategory');
    }

    public function delete_category($category_id)
    {
        DB::table('tbl_category')->where('category_id',$category_id)
        ->delete();
        session(['message' => 'category deleted successfully']);
        return Redirect::to('/allCategory');
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
