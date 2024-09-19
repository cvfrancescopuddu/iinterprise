<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Client;

class DashboardController extends Controller
{
    public function countClients(){
        $count = Client::all()->count();
        return view('dashboard', compact('count'));
    }
}
