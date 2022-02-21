<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Canteen;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $customers = User::where('role', 'customer')->get();
        $canteens = Canteen::all();
        return view('admin.home', compact('customers', 'canteens'));
    }
}
