<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function list()
    {
        $clients = Client::where('user_id', Auth::id())->paginate(10);
        return view('clients.list', compact('clients'));
    }

    //redirect to create client page
    public function create()
    {
        return view('clients.create');
    }

    //redirect page to update client
    public function edit($id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        if (!$client) {
            abort(404);
        }
        return view('clients.edit', compact('client'));
    }


    public function show($id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        if (!$client) {
            abort(404);
        }
        return view('clients.show', compact('client'));
    }

    //save client
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'cellulare' => 'required|string|max:255',
            'email' => 'required|email|unique:clienti',
            'citta' => 'required|string|max:255',
            'tipo' => 'required|max:20',
            'status' => 'required|string|max:20',
            'note' => 'required|string',
        ]);

        if ($request) {
            $client = new Client();
            $client->nome = $request->input('nome');
            $client->cognome = $request->input('cognome');
            $client->cellulare = $request->input('cellulare');
            $client->email = $request->input('email');
            $client->citta = $request->input('citta');
            $client->tipo = $request->input('tipo');
            $client->status = $request->input('status');
            $client->note = $request->input('note');
            $client->user_id = Auth::id();
            $client->save();

            return redirect()->route('client.list')->with('success', 'Client created successfully!');
        }
    }

    //update client
    public function update(Request $request, $id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        if (!$client) {
            abort(404);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'cellulare' => 'required|string|max:255',
            'email' => 'required|email|unique:clienti,email,'. $client->getKey(). ',' . $client->getKeyName(),
            'citta' => 'required|string|max:255',
            'tipo' => 'required|max:20',
            'status' => 'required|string|max:20',
            'note' => 'required|string',
        ]);

        $client->nome = $request->input('nome');
        $client->cognome = $request->input('cognome');
        $client->cellulare = $request->input('cellulare');
        $client->email = $request->input('email');
        $client->citta = $request->input('citta');
        $client->tipo = $request->input('tipo');
        $client->status = $request->input('status');
        $client->note = $request->input('note');
        $client->user_id = Auth::id();
        $client->save();

        return redirect()->route('client.list')->with('success', 'Client updated successfully!');
    }


    //delete and destroy data

    public function destroy($id){
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        $client->delete();

        return redirect()->route('client.list');
    }

//redirect to trashed data
    public function trashed(){
        $clients = Client::where('user_id', Auth::id())->onlyTrashed()->paginate(10);
        return view('clients.trashed',  compact('clients'));
    }


    //restore trashed data
    public function restore($id){
        $client = Client::where('user_id', Auth::id())->onlyTrashed()->findOrFail($id);
        $client->restore();
        return view('clients.list');
    }
    //search data in list
    public function search(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::where('nome', 'LIKE', "%{$search}%")
            ->orWhere('cognome', 'LIKE', "%{$search}%")
            ->orWhere('cellulare', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('citta', 'LIKE', "%{$search}%")
            ->orWhere('tipo', 'LIKE', "%{$search}%")
            ->orWhere('status', 'LIKE', "%{$search}%")
            ->orWhere('note', 'LIKE', "%{$search}%")
            ->paginate(10);

            if($search== ""){
                $clients =Client::where('user_id', Auth::id())->paginate(10);
            }

        return view('clients.list', compact('clients'));
    }

//update status from list
    public function updateStatus(Request $request, $id, $status)
    {
        $client = Client::findOrFail($id);

        if (!in_array($status, ['chiamato', 'trattativa', 'chiuso', 'ospite'])) {
            return back()->withError('Invalid status');
        }

        $client->status = $status;
        $client->save();

        return back()->withSuccess('Status updated successfully');
    }
}
