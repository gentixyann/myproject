<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;


class TaskController extends Controller
{
    public function index()
    {
    	// Folder モデルの all クラスメソッドですべてのフォルダデータをデータベースから取得
    	 $folders = Folder::all();

    	 return view('tasks/index'. [
    	 	'folders' => $folders,
    	 ]);
    }
}
