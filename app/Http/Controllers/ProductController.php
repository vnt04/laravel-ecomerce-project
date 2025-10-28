<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        return "get products list";
    }

    public function create(Request $request) {
        return "create a new product here.";
    }
}
