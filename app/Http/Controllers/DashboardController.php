<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function countClients()
    {
        $userId = Auth::id();

        // Caching the counts
        $count = Cache::remember("client_count_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)->count();
        });

        $urgentTasks = Cache::remember("urgent_tasks_count_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where(function($query) {
                    $query->where('status', 'trattativa')
                          ->orWhere('status', 'chiamare');
                })->count();
        });

        $importantTasks = Cache::remember("important_tasks_count_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where('status', 'chiamato')
                ->count();
        });

        $doneTasks = Cache::remember("done_tasks_count_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where(function($query) {
                    $query->where('status', 'chiuso')
                          ->orWhere('status', 'ospite');
                })->count();
        });

        return view('dashboard', compact('count', 'urgentTasks', 'importantTasks', 'doneTasks'));
    }

    // Filter by urgent status
    public function urgentFilter() {
        $userId = Auth::id();

        $clients = Cache::remember("urgent_clients_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where(function($query) {
                    $query->where('status', 'trattativa')
                          ->orWhere('status', 'chiamare');
                })->paginate(10);
        });

        return view('clients.list', compact('clients'));
    }

    // Filter by important status
    public function importantFilter(Request $request)
    {
        $userId = Auth::id();

        $clients = Cache::remember("important_clients_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where('status', 'chiamato')
                ->paginate(10);
        });

        return view('clients.list', compact('clients'));
    }

    // Filter by done status
    public function doneFilter(Request $request)
    {
        $userId = Auth::id();

        $clients = Cache::remember("done_clients_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)
                ->where(function($query) {
                    $query->where('status', 'chiuso')
                          ->orWhere('status', 'ospite');
                })->paginate(10);
        });

        return view('clients.list', compact('clients'));
    }

    // Get data for charts
    public function chartData()
    {
        $userId = Auth::id();

        // Caching the client data
        $clientData = Cache::remember("client_data_{$userId}", 60, function() use ($userId) {
            return Client::where('user_id', $userId)->get();
        });

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

        $urgentRatio = ($totalCount > 0) ? ($urgentCounter / $totalCount) * 100 : 0;
        $importantRatio = ($totalCount > 0) ? ($importantCounter / $totalCount) * 100 : 0;
        $doneRatio = ($totalCount > 0) ? ($doneCounter / $totalCount) * 100 : 0;

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