<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Client;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function countClients()
    {
        $count = Client::where('user_id', Auth::id())->count();

        $urgentTasks = Client::where('user_id', Auth::id())
            ->where(function($query) {
                $query->where('status', 'trattativa')
                      ->orWhere('status', 'chiamare');
            })->count();

        $importantTasks = Client::where('user_id', Auth::id())
            ->where('status', 'chiamato')
            ->count();

        $doneTasks = Client::where('user_id', Auth::id())
        ->where(function($query) {
            $query->where('status', 'chiuso')
                  ->orWhere('status', 'ospite');
        })->count();

        return view('dashboard', compact('count', 'urgentTasks', 'importantTasks', 'doneTasks'));
    }

//filter by urgent status
    public function urgentFilter() {
        // Crea una query per i clienti dell'utente autenticato
        $clientsQuery = Client::where('user_id', Auth::id())
            ->where(function($query) {
                $query->where('status', 'trattativa')
                      ->orWhere('status', 'chiamare');
            });
    
        // Esegui la paginazione sulla query
        $clients = $clientsQuery->paginate(10);
        
        return view('clients.list', compact('clients'));
    }



    // filter by important status
    public function importantFilter(Request $request)
    {
        $clientsQuery = Client::where('user_id', Auth::id())
        ->where(function($query) {
            $query->where('status', 'chiamato');
        });

    // Esegui la paginazione sulla query
    $clients = $clientsQuery->paginate(10);
    
    return view('clients.list', compact('clients'));
    }


    // filter by  done status
    public function doneFilter(Request $request)
    {
        $clientsQuery = Client::where('user_id', Auth::id())
            ->where(function($query) {
                $query->where('status', 'chiuso')
                      ->orWhere('status', 'ospite');
            });
    
        // Esegui la paginazione sulla query
        $clients = $clientsQuery->paginate(10);
        
        return view('clients.list', compact('clients'));
    }




    //get data for charts
    public function chartData()
    {

        //generic get
        $clientData = Client::where('user_id', Auth::id())->get();

        //type get
        $b2bCount = $clientData->where('tipo', 'b2b')->count();
        $b2cCount = $clientData->where('tipo', 'b2c')->count();

        $totalCount = $clientData->count();

        $trattativa = $clientData->where('status', 'trattativa')->count();
        $chiamare = $clientData->where('status', 'chiamare')->count();
        $urgentCounter = $trattativa + $chiamare;


        $importantCounter = $clientData->where('status', 'chiamato')->count();

        $chiuso = $clientData->where('status', 'chiuso')->count();
        $ospite = $clientData->where('status', 'ospite')->count();
        $doneCounter = $chiuso + $ospite;


        $urgentRatio =  ($urgentCounter / $totalCount) * 100;
        $importantRatio = ($importantCounter / $totalCount) * 100;
        $doneRatio = ($doneCounter / $totalCount) * 100;

        return response()->json([

            'b2b' => $b2bCount,
            'b2c' => $b2cCount,

            'urgent' => $urgentCounter,
            'important' => $importantCounter,
            'done' => $doneCounter,

            'urgentRatio' => $urgentRatio,
            'importantRatio' => $importantRatio,
            'doneRatio' => $doneRatio,
        ]);
    }
}
