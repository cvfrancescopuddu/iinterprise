<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
   public function list(){
    $clients = Client::paginate(10);
    return  view('clients.list', compact('clients'));
   }
}
