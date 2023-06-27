<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function get(Request $request) {
        return $request->user()->tasks()->orderBy('completed')->get();
    }

    public function add(Request $request) {
        $task = $request->all();
        $task['user_id'] = Auth::user()->id;
        
        return Task::create($task);
    }

    // public function update(int $task_id) {
    //     return Task::destroy($task_id);
    // }

    public function completed(int $task_id) {
        //return Task::where('id', $task_id)->;
    }

    public function delete(int $task_id) {
        return Task::destroy($task_id);
    }
    
}
