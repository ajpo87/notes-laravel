<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index($value)
    {
      return view('main',['value' => $value, 'name' => 'John']);
    }

    public function page2($value)
    {
      return view('page2',['value' => $value, 'name' => 'page2']);
    }

    public function page3($value)
    {
      return view('page3',['value' => $value, 'name' => 'page3']);
    }
}

