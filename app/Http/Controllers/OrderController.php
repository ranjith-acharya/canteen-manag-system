<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPlaced;
use App\Notifications\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'count' => 'required',
        ]);
        // return $request;
        $fields = $request->all();
        $fields['customer_id'] = Auth::id();
        $fields['reference'] = Str::random('20');
        $fields['total'] = $request->count * $request->price;
        if($request->offer == ""){
            $fields['offer'] = "0";
        }else{
            $fields['offer'] = $request->offer;
        }
        $fields['customer_status'] = 'ordered';
        $fields['status']= 'received';

        $admins = User::whereHas(
            'roles', function($q){
                $q->where('name', 'admin');
            }
        )->pluck('id');
        // return $admins;
        foreach($admins as $admin){
            User::findOrFail($admin)->notify(new OrderPlaced($request->name, Auth::user()->name, $fields['reference']));
            Session::flash('status', 'New Order!');
            // return Auth::user()->name;
        }
        
        // return $fields;
        Order::create($fields);
        return redirect()->route('canteen.show', $request->canteen_id)->with('status', 'Order Placed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStatus(Request $request){
        // return $request;
        $this->validate($request, [
            'status' => 'required',
        ]);
        $order = Order::findOrFail($request->order_id);
        $fields = $request->all();
        if($fields['status'] == 'received'){
            $fields['customer_status'] = 'ordered';
            $order->user->notify(new Status($fields['customer_status'], route('order.show', $request->order_id)));
        }
        if($fields['status'] == 'in-progress'){
            $fields['customer_status'] = 'in-progress';
            $order->user->notify(new Status($fields['customer_status'], route('order.show', $request->order_id)));
        }
        if($fields['status'] == 'on-the-way'){
            $fields['customer_status'] = 'on-the-way';
            $order->user->notify(new Status($fields['customer_status'], route('order.show', $request->order_id)));
        }
        if($fields['status'] == 'delivered'){
            $fields['customer_status'] = 'delivered';
            $order->user->notify(new Status($fields['customer_status'], route('order.show', $request->order_id)));
        }
        if($fields['status'] == 'cancelled'){
            $fields['customer_status'] = 'cancelled';
            $order->user->notify(new Status($fields['customer_status'], route('order.show', $request->order_id)));
        }
        // return $fields;
        // return $order;
        $order->update($fields);
        return redirect()->route('admin.order.show', $request->order_id)->with('status', 'Status Changed!');
    }
}
