<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        return view("main");
    }
    public function about()
    {
        return view("about");
    }
    public function service()
    {
        return view("service");
    }
    public function project()
    {
        return view("projects");
    }
    public function contact()
    {
        return view("contact");
    }
}
