<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function list()
    {
        $clients = Client::paginate(10);
        return  view('clients.list', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|string|max:20',
        ]);

        try {
            $client = new Client();
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->phone = $request->input('phone');
            $client->save();

            return redirect()->route('clients.list')->with('success', 'Client created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('clients.list')->with('error', 'Error creating client: ' . $e->getMessage());
        }
    }
}
