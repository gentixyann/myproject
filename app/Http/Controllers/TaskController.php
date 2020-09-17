<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Folder;
use App\Task;


class TaskController extends Controller
{
    public function index(int $id)
    {
    	// Folder モデルの all クラスメソッドですべてのフォルダデータをデータベースから取得
    	 $folders = Folder::all();

    	 // 選ばれたフォルダを取得する
    	 $current_folder = Folder::find($id);

    	 // 選ばれたフォルダに紐づくタスクを取得する
    	 $tasks = $current_folder->tasks()->get();

    	 // dd($folders);
    	 return view('tasks/index', [
    	 	// 「$folders」や「$tasks」がbladeで使われる
    	 	'folders' => $folders,
    	 	'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
    	 ]);
    }

    /**
	 * GET /folders/{id}/tasks/create
	 */
	public function showCreateForm(int $id)
	{
	    return view('tasks/create', [
	        'folder_id' => $id
	    ]);
	}

	public function create(int $id, CreateTask $request)
    {
	    $current_folder = Folder::find($id);

	    $task = new Task();
	    $task->title = $request->title;
	    $task->due_date = $request->due_date = date('Y-m-d H:i:s');
	    // dd($task->due_date);


	    $current_folder->tasks()->save($task);

	    return redirect()->route('tasks.index', [
	        'id' => $current_folder->id,
	    ]);
    }

    /**
	 * GET /folders/{id}/tasks/{task_id}/edit
	 */
	public function showEditForm(int $id, int $task_id)
	{
	    $task = Task::find($task_id);

	    return view('tasks/edit', [
	        'task' => $task,
	    ]);
	}





}
