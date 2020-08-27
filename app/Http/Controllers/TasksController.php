<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;  //追加

class TasksController extends Controller
{
    
    //getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        //認証済みの場合
        $data = [];
        if (\Auth::check()) {
            //認証済みユーザを取得
            $user = \Auth::user();
            //ユーザのタスク一覧を取得
            $tasks = $user->tasks();
            //メッセージ一覧を取得
            // $tasks = Task::all();
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
             return view('tasks.index', $data);
        }
        // メッセージ一覧ビューでそれを表示
        return view('welcome', $data);
        
        //メッセージ一覧ビューでそれを表示(旧)
        // // return view('tasks.index', [
        //     'tasks' => $tasks,
        //     ]);
    }

    //getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        
        $task = new Task;
        
        //メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
            ]);
    }

    //postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        //バリデーション追加
        $request->validate([
            'status' => 'required|max:10',   //20200807追加
            'content' => 'required|max:255', //20200806追加
            ]);
        //タスクを作成
        $request->user()->tasks()->create ([
            'status' => $request->status,    //20200824変更
            'content' => $request->content,
            ]);
        //tasklist課題コード
            // $task = new Task;
            // $task->status = $request->status;    //20200807追加
            // $task->content = $request->content;
            // $task->save();
        
        //前のURLへリダイレクトさせる
        return redirect('/tasks');
    }

    //getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        //idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク詳細ビューでそれを表示
         if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);
        } 
            return redirect('/tasks');
    }

    //getでtasks/id/editにアクセスされた場合の「更新画面処理表示」
    public function edit($id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        //タスク編集ビューでそれを表示
        if (\Auth::id() === $task->user_id) {
        return view('tasks.edit', [
            'task' => $task,
            ]);
        }
        return redirect('/tasks');
    }

    //putでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //バリデーション追加
        $request->validate([
            'status' => 'required|max:10',   //20200807追加
            'content' => 'required|max:255', //20200806追加
            ]);

        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを更新
        if (\Auth::id() === $task->user_id) {
        $task->status = $request->status; //20200807追加
        $task->content = $request->content;
        $task->save();
        }
        //トップページへリダイレクトさせる
        return redirect('/tasks');
    }

    //deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        //idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        //タスクを削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        //トップページへリダイレクトさせる
        return redirect('/tasks');
    }
}
