<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    public function list()
    {
        $clients = Cache::remember("clients_list_" . Auth::id(), 60, function () {
            return Client::where('user_id', Auth::id())->paginate(10);
        });
        return view('clients.list', compact('clients'));
    }

    public function create()
    {
        $types = Cache::remember('client_types', 60, function () {
            return Type::pluck('tipo_cliente', 'tid');
        });
        $statuses = Cache::remember('client_statuses', 60, function () {
            return Status::pluck('nome_status', 'sid');
        });

        return view('clients.create', compact('types', 'statuses'));
    }

    public function edit($id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        $statuses = Cache::remember('client_statuses', 60, function () {
            return Status::all()->pluck('nome_status', 'sid');
        });
        $types = Cache::remember('client_types', 60, function () {
            return Type::all()->pluck('tipo_cliente', 'tid');
        });
        if (!$client) {
            abort(404);
        }
        return view('clients.edit', compact('client', 'statuses', 'types'));
    }

    public function show($id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        if (!$client) {
            abort(404);
        }
        return view('clients.show', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
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

            // Clear the cache after creating a client
            Cache::forget("clients_list_" . Auth::id());

            return redirect()->route('client.list')->with('success', 'Client created successfully!');
        }
    }

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
            'email' => 'required|email|unique:clienti,email,' . $client->getKey() . ',' . $client->getKeyName(),
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

        // Clear the cache after updating a client
        Cache::forget("clients_list_" . Auth::id());

        return redirect()->route('client.list')->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
        $client->delete();

        // Clear the cache after deleting a client
        Cache::forget("clients_list_" . Auth::id());

        return redirect()->route('client.list');
    }

    public function trashed()
    {
        $clients = Cache::remember("trashed_clients_" . Auth::id(), 60, function () {
            return Client::where('user_id', Auth::id())->onlyTrashed()->paginate(10);
        });
        return view('clients.trashed', compact('clients'));
    }

    public function restore($id)
    {
        $client = Client::where('user_id', Auth::id())->onlyTrashed()->findOrFail($id);
        $client->restore();

        // Clear the cache after restoring a client
        Cache::forget("trashed_clients_" . Auth::id());
        Cache::forget("clients_list_" . Auth::id());

        return redirect()->route('client.list');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $clients = Cache::remember("clients_search_{$search}_" . Auth::id(), 60, function () use ($search) {
            return Client::where('nome', 'LIKE', "%{$search}%")
                ->orWhere('cognome', 'LIKE', "%{$search}%")
                ->orWhere('cellulare', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('citta', 'LIKE', "%{$search}%")
                ->orWhere('tipo', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%")
                ->orWhere('note', 'LIKE', "%{$search}%")
                ->paginate(10);
        });

        if ($search == "") {
            $clients = Cache::remember("clients_list_" . Auth::id(), 60, function () {
                return Client::where('user_id', Auth::id())->paginate(10);
            });
        }

        return view('clients.list', compact('clients'));
    }

    public function updateStatus(Request $request, $id, $status)
    {
        $client = Client::findOrFail($id);

        if (!in_array($status, ['chiamato', 'chiamare', 'trattativa', 'chiuso', 'ospite'])) {
            return back()->withError('Invalid status');
        }

        $client->status = $status;
        $client->save();

        // Clear the cache after updating status
        Cache::forget("clients_list_" . Auth::id());

        return back()->withSuccess('Status updated successfully');
    }
}