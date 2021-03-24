<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;

class SliderController extends Controller
{
    public function addProduct()
    {
        return view('admin.add_product');
    }

    public function allSlider()
    {
        $all_slider_info = DB::table('tbl_slider')
        ->where('publication_status',1)
        ->get();

        $manage_product = view('admin.all_slider')
            ->with('all_slider_info', $all_slider_info);
        return $manage_product;
        // return view('admin_layout')->with('admin.all_category',$manage_category);
    }

    public function saveSlider(Request $request)
    {
        $data = array();
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('slider_image');
        if ($image) {
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'slider/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['slider_image'] = $image_url;
                DB::table('tbl_slider')->insert($data);
                $request->session()->put('message', 'slider added successfully');
                return Redirect::to('/addSlider');
            }
        }

        $data['slider_image'] = '';
        DB::table('tbl_slider')->insert($data);
        $request->session()->put('message', 'slider added successfully without image');
        return Redirect::to('/addSlider');
    }

    public function active_unactive_slider($slider_id, $product_status)
    {
        if ($product_status == 1) {
            DB::table('tbl_slider')
                ->where('slider_id', $slider_id)
                ->update(['publication_status' => 0]);
            session(['message' => 'slider inactivate']);
        } else {
            DB::table('tbl_slider')
                ->where('slider_id', $slider_id)
                ->update(['publication_status' => 1]);
            session(['message' => 'slider activate']);
        }
        return Redirect::to('/allManufacture');
    }

    public function edit_slider($manaufacture_id)
    {
        $manaufacture_info = DB::table('tbl_slider')
            ->where('manaufacture_id', $manaufacture_id)
            ->first();
        return view('admin.edit_manaufacture')->with('manaufacture_info', $manaufacture_info);
    }

    // public function update_slider(Request $request, $slider_id)
    // {
    //     $slider_name = $request->manaufacture_name;
    //     $manaufacture_description = $request->manaufacture_description;
    //     DB::table('tbl_slider')
    //         ->where('manaufacture_id', $slider_id)
    //         ->update(['manaufacture_name' => $slider_name, 'manaufacture_description' => $manaufacture_description]);
    //     session(['message' => 'Manufacture updated successfully']);
    //     return Redirect::to('/allManufacture');
    // }

    public function delete_slider($slider_id)
    {
        DB::table('tbl_slider')->where('slider_id', $slider_id)
            ->delete();
        session(['message' => 'slider deleted successfully']);
        return Redirect::to('/allProduct');
    }
}
