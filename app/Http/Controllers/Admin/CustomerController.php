<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use App\Rules\allowedEmailDomain;

class CustomerController extends Controller
{
    public function show($id){
        $customer = User::findOrFail($id);
        $profile = Profile::where('customer_id', $id)->get();
        return view('admin.customer', compact('customer', 'profile'));
    }

    public function store(Request $request){
        // return $request;
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', new allowedEmailDomain],
            'password' => ['required', 'string', 'min:8'],
            'card' => ['required', 'string', 'max:16', 'min:16', 'unique:users'],
            'cardcvv' => ['required', 'string', 'max:4', 'min:3'],
        ], [
            'name.required' => 'Mention your Full name',
            'email.required' => 'Mention your Email address',
            'password.required' => 'Mention Password for your account',
            'card.required' => 'Provide your Card number',
            'card.unique' => 'Card exists in our System',
            'card.min' => 'Card number must be atleast 16 characters',
            'card.max' => 'Card number must be atleast 16 characters',
            'cardcvv.min' => 'Card CVV must be atleast 3 to 4 characters',
            'cardcvv.max' => 'Card CVV must be atleast 3 to 4 characters',
            'cardcvv.required' => 'Provide your Card CVV mentioned at back of your card',
        ]);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        // return $fields;
        $user = User::create($fields);
        $user->assignRole('customer');
        return redirect()->route('admin.home')->with('status', 'Customer Added!');
    }
}
