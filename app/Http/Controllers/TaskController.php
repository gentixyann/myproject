<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
