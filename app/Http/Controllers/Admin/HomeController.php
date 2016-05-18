<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Amersur\Http\Controllers\Controller;

class HomeController extends Controller{

    public function index()
    {
    	return view('admin.home');
    }

} 