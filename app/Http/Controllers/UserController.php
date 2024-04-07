<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        // return response("Bu yerda barcha userlar ro'yhati mavjud!",201,['header'=>'header1']);
        return redirect("users/create");
    }
    public function show(Request $request,$user)
    {
        dd($request->ip());
        return view("users.show",["user"=>$user]);
    }
    public function create()
    {
        return view("users.create");
    }
    public function store(Request $request)
    {
        dd($request->all());
    }
}
