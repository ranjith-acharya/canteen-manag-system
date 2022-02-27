<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markRead(){
		Auth::user()->unreadNotifications->markAsRead();
		return redirect()->back();
	}
}
