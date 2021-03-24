<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;


class ProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.add_product');
    }

    public function allProduct()
    {
        $all_product_info = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manaufacture','tbl_products.manufacture_id','=','tbl_manaufacture.manaufacture_id')
        ->where('publication_status',1)
        ->get();

        $manage_product = view('admin.all_product')
            ->with('all_product_info', $all_product_info);
        return $manage_product;
        // return view('admin_layout')->with('admin.all_category',$manage_category);
    }

    public function saveProduct(Request $request)
    {
        // dd($request->all());
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('product_image');
        // dd($image);
        if ($image) {
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'image/';
            $image_url = $upload_path . $image_full_name;
            // dd($image);
            // dd($upload_path);
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;
                DB::table('tbl_products')->insert($data);
                $request->session()->put('message', 'products added successfully');
                return Redirect::to('/addProduct');
            }
        }

        $data['product_image'] = '';
        DB::table('tbl_products')->insert($data);
        $request->session()->put('message', 'products added successfully without image');
        return Redirect::to('/addProduct');
    }

    public function active_unactive_product($product_id, $product_status)
    {
        if ($product_status == 1) {
            DB::table('tbl_products')
                ->where('product_id', $product_id)
                ->update(['publication_status' => 0]);
            session(['message' => 'product inactivate']);
        } else {
            DB::table('tbl_products')
                ->where('product_id', $product_id)
                ->update(['publication_status' => 1]);
            session(['message' => 'product activate']);
        }
        return Redirect::to('/allManufacture');
    }

    public function edit_manufacture($manaufacture_id)
    {
        $manaufacture_info = DB::table('tbl_products')
            ->where('manaufacture_id', $manaufacture_id)
            ->first();
        return view('admin.edit_manaufacture')->with('manaufacture_info', $manaufacture_info);
    }

    public function update_manufacture(Request $request, $manaufacture_id)
    {
        $manaufacture_name = $request->manaufacture_name;
        $manaufacture_description = $request->manaufacture_description;
        DB::table('tbl_products')
            ->where('manaufacture_id', $manaufacture_id)
            ->update(['manaufacture_name' => $manaufacture_name, 'manaufacture_description' => $manaufacture_description]);
        session(['message' => 'Manufacture updated successfully']);
        return Redirect::to('/allManufacture');
    }

    public function delete_product($product_id)
    {
        DB::table('tbl_products')->where('product_id', $product_id)
            ->delete();
        session(['message' => 'product deleted successfully']);
        return Redirect::to('/allProduct');
    }
}
