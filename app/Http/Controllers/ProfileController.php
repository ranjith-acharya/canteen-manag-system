<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
            'branch' => 'required',
            'department' => 'required',
            'year' => 'required',
            'contact' => 'required|max:10',
            'instagram' => 'required',
            'linkedin' => 'required',
            'avatar' => 'required',
        ], [
            'branch.required' => 'Do select branch!',
            'department.required' => 'Do select department',
            'year.required' => 'Select your current year',
            'contact.required' => 'Do provide contact number',
            'instagram.required' => 'Enter your Instagram ID',
            'linkedin.required' => 'Enter your Linkedin ID',
            'avatar.required' => 'Choose an avatar',
        ]);
        $fields = $request->all();
        $fields['customer_id'] = Auth::id();
        if($request->hasfile('avatar')){
            $file = $request->file('avatar');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file -> move(public_path().'/img/user/', $name);
            $fields['avatar'] = $name;
        }
        $userAvatar = User::findorFail(Auth::id());
        $userAvatar['avatar'] = $name;
        // return $userAvatar;
        $userAvatar->update();
        Profile::create($fields);
        return redirect()->route('profile.show', Auth::id())->with('status', 'Profile Updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $user = User::findOrFail($id);
        $profiles = Profile::where('customer_id', $id)->get();
        // return $profiles;
        return view('profile.show', compact('user', 'profiles'));
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
        // return $request;
        // return $id;
        // $customer = Profile::findOrFail($id)->customer_id;
        // return User::findOrFail($customer);
        $this->validate($request, [
            'branch' => 'required',
            'department' => 'required',
            'year' => 'required',
            'contact' => 'required|max:10',
        ], [
            'branch.required' => 'Do select branch!',
            'department.required' => 'Do select department',
            'year.required' => 'Select your current year',
            'contact.required' => 'Do provide contact number',
        ]);
        $fields = $request->all();
        $fields['customer_id'] = Auth::id();
        $profile = Profile::find($id);
        $customerID = Profile::findOrFail($id)->customer_id;
        $customer = User::findOrFail($customerID);
        $customer['card'] = $request->card;
        $customer['cardcvv'] = $request->cardcvv;
        // return $profile;
        
        $customer->save();
        $profile->update($fields);
        return redirect()->route('profile.show', Auth::id())->with('status', 'Profile Updated!');
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
}
