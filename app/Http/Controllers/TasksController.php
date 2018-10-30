<?php

/*
Rev.1.04 確認中→確認中 でコメントが消える件修正
Rev.1.05 契約解除された客先を非表示に (visible_flag追加)
*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Customer;
use App\Member;
use App\Category;
use App\User;

use Carbon\Carbon;
use Slack;

use App\Http\Requests;


class TasksController extends Controller
{
    //

   public function __construct()
    {
        $this->middleware('auth');
    }

  public function index(Request $request)
    {
      $dt = Carbon::now('Asia/Tokyo');
      $dt2 = Carbon::now('Asia/Tokyo')->addDay(2);

      //  //顧客選択用
      $tasks_poster = Task::all();
      //
      $customers = Customer::where('visible_flag',1)->get();
      $categories = Category::all();
      $members = Member::where('visible_flag',1)->get();

      //キーワード受け取り
      $customer_id = $request->input('customer_id');
      $category_id = $request->input('category_id');
      $member_id = $request->input('member_id');
      $poster_name = $request->input('poster_name');
      $keyword = $request->input('keyword');

      $query = Task::query();


      // もし顧客選択されていたら
        if($customer_id !== null)
        {
          if($customer_id == 1){}
          else{
        $query->where('tasks.customer_id', $customer_id);
        }};

      // もしカテゴリが選択されていたら
        if($category_id !== null)
        {
          if($category_id == 0){}
            else{
          $query->where('tasks.category_id', $category_id);
        }};

        // もし担当が選択されていたら
        if($member_id !== null)
        {
          if($member_id == 0){}
            else{
          $query->where('tasks.member_id', $member_id);
          }};

          // もし担当が選択されていたら
          if($poster_name !== null)
          {
            if($poster_name == 0){}
              else{
            $query->where('投稿', $poster_name);
            }};


      //   //もしキーワードがあったら
         // if($keyword !== null)
         // {
         //   $query->where('件名','like','%'.$keyword.'%')->orWhere('内容','like','%'.$keyword.'%');
         // }

      if($keyword !== null){
        //全角スペースを半角に
        $keyword_split = mb_convert_kana($keyword,'s');

        //空白で区切る
        $keyword_split2 = preg_split('/[\s]+/', $keyword_split,-1,PREG_SPLIT_NO_EMPTY);

        //単語をループで回す
        // foreach($keyword_split2 as $value){
        //    $query->where('件名','like','%'.$value.'%')->orWhere('内容','like','%'.$value.'%');
        // }
        foreach($keyword_split2 as $value){
             $query->where(function($query) use($value)
                {
                  $query->where('件名','like','%'.$value.'%');
                  $query->orWhere('内容','like','%'.$value.'%');
                });
        };
      }else{

      };


      $tasks = $query
      ->join('customers', 'tasks.customer_id', '=', 'customers.customer_id')
      ->join('members', 'tasks.member_id', '=', 'members.member_id')
      ->join('categories', 'tasks.category_id', '=', 'categories.category_id')
      ->wherenotin('ステータス',['完了'])
      ->orderby('tasks.created_at','desc')
      ->select('tasks.id','ステータス','優先度','customers.customer_name','categories.category_name',
      '件名','内容','期限','投稿','tasks.created_at','members.member_name','確認','report_flag' )
      ->paginate(100);

      return view('tasks.index', compact('tasks','dt','dt2'))
      ->with('tasks',$tasks)
      ->with('tasks.customer_id',$customer_id)
      ->with('tasks.category_id',$category_id)
      ->with('tasks.member_id',$member_id)
      ->with('customers',$customers)
      ->with('keyword',$keyword)
      ->with('categories',$categories)
      ->with('members',$members);

    }

    // public function index()
    //   {
    //   $query = Task::query();
    //   $tasks = $query->wherenotin('ステータス',['完了'])->orderby('created_at','desc')->get();
    //
    //    return view('tasks.index', compact('tasks'));
    //   }


  public function show($id)
    {
//      $tasks = Task::findorFail($id);

      $tasks = Task::findorFail($id);

      // dd(array($tasks->id,
      // $tasks->category_id));

      $dt = Carbon::now('Asia/Tokyo');
      $dt2 = Carbon::now('Asia/Tokyo')->addDay(2);

      return view('tasks.show', compact('tasks','dt','dt2'));
    }

    public function edit_full($id)
      {
        $tasks = Task::findorFail($id);
        $dt = Carbon::now('Asia/Tokyo');
        $dt2 = Carbon::now('Asia/Tokyo')->addDay(2);

          return view('tasks.edit_full', compact('tasks','dt','dt2'));
      }

    public function update_full(Request $request, $id)
      {
        $task = Task::findorFail($id);
        $task->件名 = $request->件名;
        $task->内容 = $request->内容;
        $task->優先度 = $request->優先度;
        $task->期限 = $request->期限;
        //保存
        $task->save();

        return redirect()->to('/tasks/index');
      }

  public function destroy($id)
    {
      $tasks = Task::findorFail($id);
      $tasks->delete();

      return redirect()->to('/tasks/index');
    }

  public function create()
   {
     // Rev1.05 vislble_flag 1 のみ取得
      $customers = Customer::where('visible_flag',1)->get();

      $categories = Category::all();
      $members = Member::where('visible_flag',1)->get();


      return view('tasks.create', compact('tasks','customers'))
      ->with('categories',$categories)
      ->with('members',$members);
   }

  public function store(Request $request)
    {


        $this->validate($request, [
                'category_id'  => 'required|not_in:0',
              ],[
                'category_id.required' => ':attributeをいずれか設定してください',
              ],[
                'category_id' => 'category',
              ]);



        //userオブジェクト生成
        $task = Task::create();

        //値の登録
        $task->customer_id = $request->customer_id;
        $task->category_id = $request->category_id;
        $task->件名 = $request->件名;
        $task->内容 = $request->内容;
        $task->優先度 = $request->優先度;
        $task->期限 = $request->期限;
        $task->member_id = $request->member_id;
        $task->ステータス = '未対応';

        if($request->category_id == 8){
          $task->report_flag = 1;
        }else {
          # code...
        };

        $poster = $request->投稿;

        $poster_query = User::where('name',$poster)
        ->first();

        //カテゴリー名取得
        $category_query = Category::where('category_id',$request->category_id)
        ->first();
        $category_name = $category_query->category_name;


        $poster_name = $poster_query->name;
        $task->投稿 = $poster_name;

        //指定した担当から member_idを取得
        if ($request->member_id !== 0){
          $member_query = Member::where('member_id',$request->member_id)
          ->first();
          $member_name = $member_query->member_name;
          // dd($member_name);
          $task->担当 = $member_name;
        }else{};


        //保存
        $task->save();

				$task_no = $task->id;
        $title = $request->件名;

        $start_task =  "${poster_name} さんが『No.${task_no} ${category_name} ${title} 』を投稿しました。";

				  Slack::send($start_task);

        //一覧にリダイレクト
        return redirect()->to('/tasks/index');
    }

    public function edit($id)
      {
          $tasks = Task::findorFail($id);
          $members = Member::where('visible_flag',1)->get();;


          return view('tasks.edit', compact('tasks'))
          ->with('tasks',$tasks)
          ->with('members',$members);
      }

    public function edit_report($id)
      {
          $tasks = Task::findorFail($id);
          $members = Member::where('visible_flag',1)->get();;


          return view('tasks.edit_report', compact('tasks'))
          ->with('tasks',$tasks)
          ->with('members',$members);
      }

    public function change_t($id)
      {
          $tasks = Task::findorFail($id);
          $members = Member::where('visible_flag',1)->get();

          return view('tasks.change_t', compact('tasks'))
          ->with('members', $members);
      }



    public function update(Request $request, $id)
      {
          $tasks = Task::findorFail($id);
          $members = Member::where('visible_flag',1)->get();

          if ($request->ステータス == '未対応'){

            return redirect('/tasks/index');

          }elseif ($request->ステータス == '対応中'){

              if ($tasks->t_flag = 1){
                $tasks->ステータス = '対応中';
                $tasks->save();
                return redirect('/tasks/index');

              }else{

                $tasks->ステータス = '対応中';
                $tasks->担当 = $request->t_member_name;
                $tasks->対応時のメモ = $request->対応時のメモ;
                $tasks->t_flag = 1;

                //指定した対応者から member_idを取得
                if ($request->t_member_name !== 0){

                  $member = Member::where('member_name',$request->t_member_name)
        					->first();
                  $member_id = $member->member_id;
                  $tasks->member_id = $member_id;
                  }else{};

                $tasks->save();
                return redirect('/tasks/index');



              };

          }elseif ($request->ステータス == '確認中'){

            $tasks->ステータス = '確認中';
            $tasks->確認 = $request->c_member_name;
            $tasks->対応日 = date('Y/m/d H:i:s');

						//Rev.1.04 start
            if ($tasks->c_flag == 1){

            }else{
              $tasks->対応時のメモ = $request->対応時のメモ;
            }
						//Rev.1.04 end

            $tasks->c_flag = 1;


            //指定した対応者から member_idを取得
            $member = Member::where('member_name',$request->c_member_name)
            ->first();
            $member_id = $member->member_id;
            $tasks->member_id = $member_id;

            $tasks->save();

            $task_no = $tasks->id;
            $title = $tasks->件名;
            $confirm_task =  "『No.${task_no} ${title} 』のステータスが『確認中』に変更されました。";
            Slack::send($confirm_task);

            return redirect('/tasks/index');

          }elseif($request->ステータス == '完了'){

            $tasks->ステータス = '完了';
            $tasks->最終確認日 = date('Y/m/d H:i:s');
            $tasks->確認時のメモ = $request->確認時のメモ;

            $member = Member::where('member_id',$tasks->member_id)
            ->first();
            $member_name = $member->member_name;
            $tasks->確認 = $member_name;

            $tasks->save();

            $task_no = $tasks->id;
            $confirmer = $member_name;
            $title = $tasks->件名;
            $end_task =  "${confirmer} さんが『No.${task_no} ${title} 』を完了しました。";

             Slack::send($end_task);

            return redirect('/tasks/index');

          }else{};
      }


    public function update_report(Request $request, $id)
    {
      $tasks = Task::findorFail($id);
      $members = Member::where('visible_flag',1)->get();

      if ($request->ステータス == '報告中'){
          $tasks->ステータス = '報告中';
          $tasks->save();
          return redirect('/tasks/index');

      }elseif($request->ステータス == '完了'){
        $tasks->ステータス = '完了';
        $tasks->最終確認日 = date('Y/m/d H:i:s');


        $member = Member::where('member_id',$tasks->member_id)
        ->first();
        $member_name = $member->member_name;
        $tasks->確認 = $member_name;

        $tasks->save();
        return redirect('/tasks/index');

        $task_no = $tasks->id;
        $confirmer = $member_name;
        $title = $tasks->件名;
        $end_task =  "${confirmer} さんが『No.${task_no} ${title} 』を完了しました。";

         Slack::send($end_task);

      }else{
        return redirect('/tasks/index');
      };

    }

    public function update_c(Request $request, $id)

      {
          $tasks = Task::findorFail($id);

          $tasks->ステータス = $request->ステータス;
          $tasks->確認者 = $request->確認者;
          $tasks->対応日 = $request->対応日;
          $tasks->対応時のメモ = $request->対応時のメモ;
          $tasks->save();

          return redirect('/tasks/index');
      }


    public function change_upload_t(Request $request, $id)
      {
          $tasks = Task::findorFail($id);

          $tasks->member_id = $request->member_id;

          if ($tasks->c_flag == "1")
          {
            $member = Member::where('member_id',$request->member_id)
            ->first();
            $member_name = $member->member_name;
            $tasks->確認 = $member_name;

          } else {

            $member = Member::where('member_id',$request->member_id)
            ->first();
            $member_name = $member->member_name;
            $tasks->担当 = $member_name;

          }
          $tasks->save();
          return redirect('/tasks/index');
      }


    public function complete_list(Request $request)
      {

        //  //顧客選択用
        $customers = Customer::all();

        //キーワード受け取り
         $customer_id = $request->input('customer_id');
         $category_id = $request->input('category_id');
         $member_id = $request->input('member_id');

         $keyword = $request->input('keyword');
         $categories = Category::all();

         $query = Task::query();

         $category_name = $request->input('category_name');


         // //もし顧客選択されていたら
         if($customer_id !== null)
        {
           if($customer_id == 1){}
          else{
            $query->where('tasks.customer_id', $customer_id);
        }};

        // もしカテゴリが選択されていたら
        if($category_id !== null)
        {
          if($category_id == 0){}
            else{
          $query->where('tasks.category_id', $category_id);
        }};

        // もし担当が選択されていたら
        if($member_id !== null)
        {
          if($member_id == 0){}
            else{
          $query->where('tasks.member_id', $member_id);
          }};


         //   もしキーワードがあったら
         if($keyword !== null)
         {
           //全角スペースを半角に
           $keyword_split = mb_convert_kana($keyword,'s');

           //空白で区切る
           $keyword_split2 = preg_split('/[\s]+/', $keyword_split,-1,PREG_SPLIT_NO_EMPTY);

           //単語をループで回す
           foreach($keyword_split2 as $value){
              $query->where('件名','like','%'.$value.'%')->orWhere('内容','like','%'.$value.'%');
           }
         }



        $tasks = $query
        ->join('customers', 'tasks.customer_id', '=', 'customers.customer_id')
        ->join('members', 'tasks.member_id', '=', 'members.member_id')
        ->join('categories', 'tasks.category_id', '=', 'categories.category_id')
        ->wherein('ステータス',['完了'])
        ->orderby('tasks.最終確認日','desc')
        ->select('tasks.id','ステータス','customers.customer_name','categories.category_name',
        '件名','内容','期限','投稿','最終確認日','tasks.created_at')
        ->paginate(100);

        return view('tasks.complete_list')
        ->with('tasks',$tasks)
        ->with('tasks.customer_id',$customer_id)
        ->with('customers',$customers)
        ->with('categories',$categories)
        ->with('keyword',$keyword);
     }

    public function excel()
    {
      
      $stream = fopen('php://temp', 'r+b');

            $header = array("ID","ステータス",  "施設名","カテゴリ","件名","内容","期限","投稿者","最終確認日","投稿日");

			fputcsv($stream, $header);

      $csv = Task::join('customers', 'tasks.customer_id', '=', 'customers.customer_id')
        ->join('members', 'tasks.member_id', '=', 'members.member_id')
        ->join('categories', 'tasks.category_id', '=', 'categories.category_id')
        ->wherein('ステータス',['完了'])
        ->orderby('tasks.最終確認日','desc')
        ->select('tasks.id','ステータス','customers.customer_name','categories.category_name',
        '件名','内容','期限','投稿','最終確認日','tasks.created_at')
        ->get()->toArray();

      foreach ($csv as $line) {
          fputcsv($stream, $line);
      }
      
      rewind($stream);
      $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
      $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');      

      $headers = array(
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="tasks_complete.csv"',
      );

      return response($csv, 200, $headers);
      
    }


     public function link()
       {
          return view('tasks.link');
       }

     public function test()
       {
         $tasks = Task::all();
         $customers = Customer::all();
         $customer_count = Customer::count();

         $comment = Task::find(1);

         return view('tasks.test', compact('tasks','customers','customer_count','comment'));
       }

     public function test_store(Request $request)
        {
            //userオブジェクト生成
            $task = Task::create();

            //値の登録
            $task->customer_id = $request->customer_id;

            //保存
            $task->save();

            //一覧にリダイレクト
            return redirect()->to('/tasks/index');
        }

}
