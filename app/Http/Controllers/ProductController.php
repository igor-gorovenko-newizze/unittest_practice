<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\DB;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();
//        $products = DB::table('products')->paginate(10);


        return view('products.index', compact('products'));
    }

    public function create()
    {
        //
    }
}
