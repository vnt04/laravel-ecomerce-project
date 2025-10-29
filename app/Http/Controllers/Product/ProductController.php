<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request) {
        return "get products list";
    }

    public function create(Request $request) {
        return "create a new product here.";
    }
}
