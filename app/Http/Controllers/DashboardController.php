<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Client;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function countClients(){
        $count = Client::where('user_id', Auth::id())->count();

        $urgentTasks = Client::where('user_id', Auth::id())
            ->where('status', 'trattativa')
            ->count();

        $importantTasks = Client::where('user_id', Auth::id())
            ->where('status', 'chiamato')
            ->count();

        $normalTasks = Client::where('user_id', Auth::id())
            ->where('status', 'chiuso')->orWhere('status', 'ospite')
            ->count();

        return view('dashboard', compact('count', 'urgentTasks', 'importantTasks', 'normalTasks'));
    }

    // public function getTasks(){
    //     $urgentTasks = Client::where('user_id', Auth::id())
    //         ->where('status', 'trattativa')
    //         ->count();

    //     $importantTasks = Client::where('user_id', Auth::id())
    //         ->where('status', 'chiamato')
    //         ->count();

    //     $normalTasks = Client::where('user_id', Auth::id())
    //         ->where('status', 'chiuso')->orWhere('status', 'ospite')
    //         ->count();

    //     return view('dashboard', compact('urgentTasks', 'importantTasks', 'normalTasks'));
    // }

    // public function updateTasks(Request $request)
    // {
    //     $tasks = $request->input('tasks');

    //     foreach ($tasks as $taskId) {
    //         $task = Task::find($taskId);
    //         $task->completed = true;
    //         $task->save();
    //     }

    //     return redirect()->back()->with('success', 'Task updated successfully!');
    // }
}
