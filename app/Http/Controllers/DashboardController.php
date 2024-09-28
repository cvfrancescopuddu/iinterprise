<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Client;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function countClients(){
        $count = Client::where('user_id', Auth::id())->count();
        return view('dashboard', compact('count'));
    }
}
