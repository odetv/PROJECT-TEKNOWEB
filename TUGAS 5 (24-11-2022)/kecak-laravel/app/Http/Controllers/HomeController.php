<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        //memanggil view landing page pada folder frontpage
        //disertai dengan variable title yang dapat ditampilkan pada layout
        return view('frontpage.landingpage', ['title' => "Landing Page"]);
        }
}
