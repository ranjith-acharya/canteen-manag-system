<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Canteen;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $canteens = Canteen::all();
        $orders = Order::where('customer_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $orderAll = Order::where('customer_id', Auth::id())->get();
        return view('home', compact('canteens', 'orders', 'orderAll'));
    }
}
