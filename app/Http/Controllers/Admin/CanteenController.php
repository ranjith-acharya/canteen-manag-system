<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canteen;
use App\Models\FoodItem;

class CanteenController extends Controller
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
        // return $request;
        $this->validate($request, [
            'name' =>'required',
            'status' => 'required',
        ]);

        $fields = $request->all();
        Canteen::create($fields);
        return redirect()->route('admin.home')->with('status', 'Canteen Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $canteen = Canteen::findOrFail($id);
        $foodItemsVeg = FoodItem::where('canteen_id', $id)->where('type', 'veg')->get();
        $foodItemsNonVeg = FoodItem::where('canteen_id', $id)->where('type', 'non-veg')->get();
        // return $foodItemsNonVeg;
        return view('admin.canteen', compact('canteen', 'foodItemsVeg', 'foodItemsNonVeg'));
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
        // return "hello";
        $this->validate($request, [
            'status' => 'required',
        ]);
        // return $request;
        $fields = $request->all();
        // return $fields;
        $canteen = Canteen::findOrFail($request->canteen_id);
        // return $canteen;
        $canteen->update($fields);
        return redirect()->route('admin.canteen.show', $request->canteen_id)->with('status', 'Status Changed!');
    }
}
