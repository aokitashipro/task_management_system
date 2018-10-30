<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\History;
use App\Http\Requests;

class HistoriesController extends Controller
{
    //

    public function __construct()
      {
          $this->middleware('auth');
      }


      public function history()
      {

        $query = History::query();
        $histories = $query->orderby('created_at','desc')->paginate(30);

         return view('tasks.history', compact('histories'));
        }

      public function history_create()
      {
         return view('tasks.history_create', compact('histories'));
      }

      public function history_store(Request $request)
         {
             //userオブジェクト生成
             $histories = History::create();

             //値の登録
             $histories->追加日 = $request->追加日;
             $histories->バージョン = $request->バージョン;
             $histories->対応内容 = $request->対応内容;

             //保存
             $histories->save();

             //一覧にリダイレクト
             return redirect()->to('/tasks/history');
         }



}
