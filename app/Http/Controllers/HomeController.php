<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;

class HomeController extends Controller
{
    public function index(){
        $all_published_product = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manaufacture','tbl_products.manufacture_id','=','tbl_manaufacture.manaufacture_id')
        ->where('tbl_products.publication_status',1)
        ->limit(9)
        ->get();

        $manage_product = view('pages.home_content')
            ->with('all_published_product', $all_published_product);
        return $manage_product;
    }
}
