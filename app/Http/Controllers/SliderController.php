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
    public function addSlider()
    {
        return view('admin.add_slider');
    }

    public function allSlider()
    {
        $all_slider_info = DB::table('tbl_slider')
        ->get();

        $manage_product = view('admin.all_slider')
            ->with('all_slider_info', $all_slider_info);
        return $manage_product;
        // return view('admin_layout')->with('admin.all_category',$manage_category);
    }

    public function saveSlider(Request $request)
    {
        $data = array();
        $data['publication_status'] = $request->publication_status == null ? 0 : 1;

        $image = $request->file('slider_image');
        // dd($image);
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
                $request->session()->put('message', 'slider added successfully with image');
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
        return Redirect::to('/allSlider');
    }

    public function delete_slider($slider_id)
    {
        $image = DB::table('tbl_slider')
                ->where('slider_id', $slider_id);
                unlink();
        DB::table('tbl_slider')->where('slider_id', $slider_id)
            ->delete();
        session(['message' => 'slider deleted successfully']);
        return Redirect::to('/allSlider');
    }
}
