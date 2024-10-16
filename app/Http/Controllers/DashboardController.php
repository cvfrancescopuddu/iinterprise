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
            ->where('status', 'trattativa')->orWhere('status', 'chiamare')
            ->count();

        $importantTasks = Client::where('user_id', Auth::id())
            ->where('status', 'chiamato')
            ->count();

        $doneTasks = Client::where('user_id', Auth::id())
            ->where('status', 'chiuso')->orWhere('status', 'ospite')
            ->count();

        return view('dashboard', compact('count', 'urgentTasks', 'importantTasks', 'doneTasks'));
    }


    // filter by  urgents status
    public function urgentFilter(Request $request)
    {
        $statuses = $request->input('statuses', ['trattativa', 'chiamare']);
        $clients = Client::where('user_id', Auth::id());

        if (in_array('trattativa', $statuses) || in_array('chiamare', $statuses)) {
            $clients->where('status', 'LIKE', "%{$statuses[0]}%")
                ->orWhere('status', 'LIKE', "%{$statuses[1]}%");

        }
        $clients = $clients->paginate(10);
        return view('clients.list', compact('clients'));
    }

    // filter by important status
    public function importantFilter(Request $request)
    {
        $statuses = $request->input('statuses', 'chiamato');
        $clients = Client::where('user_id', Auth::id());

        if ($statuses=='chiamato') {
            $clients->where('status', 'LIKE', "%{$statuses}%");
        }

        $clients = $clients->paginate(10);
        return view('clients.list', compact('clients'));
    }

     // filter by  urgents status
    public function doneFilter(Request $request)
     {
         $statuses = $request->input('statuses', ['chiuso', 'ospite']);
         $clients = Client::where('user_id', Auth::id());
 
         if (in_array('chiuso', $statuses) || in_array('ospite', $statuses)) {
             $clients->where('status', 'LIKE', "%{$statuses[0]}%")
                 ->orWhere('status', 'LIKE', "%{$statuses[1]}%");
 
         }
         $clients = $clients->paginate(10);
         return view('clients.list', compact('clients'));
     }
 





    //select clients for chart
    public function chartData()
    {
        $b2bCount = Client::where('user_id', Auth::id())->where('tipo', 'b2b')->count();
        $b2cCount = Client::where('user_id', Auth::id())->where('tipo', 'b2c')->count();

        $totalCount = Client::where('user_id', Auth::id())->count();

        $urgentCounter = Client::where('user_id', Auth::id())
            ->where('status', 'trattativa')
            ->orWhere('status', 'chiamare')->count();

        $importantCounter = Client::where('user_id', Auth::id())
            ->where('status', 'chiamato')->count();

        $doneCounter = Client::where('user_id', Auth::id())
            ->where('status', 'chiuso')
            ->orWhere('status', 'ospite')->count();

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
