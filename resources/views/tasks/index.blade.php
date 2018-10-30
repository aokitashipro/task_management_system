@extends('layouts.master')

@section('content')


<div class="mgb10"></div>

<form class="form-inline" action="{{url('/tasks/index')}}">
<div class="form-group">

  <div class="row">

    <div class="col-xs-6 col-md-4 mgb10">
      <div class="box">
        <label class="mgr10">施設</label>
        <select name="customer_id" class="form-control">
        @foreach ($customers as $customer)
        <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
        @endforeach
        </select>

      </div>
    </div>

    <div class="col-xs-6 col-md-4 mgb10">
      <div class="box">
        <label class="mgr10">カテゴリ</label>
        <select name="category_id" class="form-control">
        @foreach ($categories as $category)
        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
        @endforeach
        </select>
      </div>
    </div>

    <div class="col-xs-6 col-md-4 mgb10">
      <div class="box ">
        <label class="mgr10">担当</label>
        <select name="member_id" class="form-control">
        @foreach ($members as $member)
        <option value="{{$member->member_id}}">{{$member->member_name}}</option>
        @endforeach
        </select>
      </div>
    </div>

    <div class="col-xs-6 col-md-4 col-lg-3 mgb10">
      <div class="box">
        <label class="mgr10">検索(件名or内容)　</label>
        <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="">
      </div>
    </div>

  </div><!-- row -->


    <br><br>
  <div style="margin-left: 20px; ">
  	<input type="submit" value="検索" class="btn btn-info">
  </div>

</div>
</form>

<div style="text-align:center">{{ $tasks->links() }}</div>


<div id="tasks_table">
<table class="table table-striped">
<thead>
  <tr>
    <th class="sort" data-sort="index_id">ID</th>
    <th class="sort" data-sort="index_status">ステータス</th>
    <th class="sort" data-sort="index_priority">優先度</th>
    <th class="sort" data-sort="index_customers">施設名</th>
    <th class="sort" data-sort="index_category">カテゴリ</th>
    <th class="sort" data-sort="index_title">件名</th>
    <th class="sort" data-sort="index_contents">内容</th>
    <th class="sort" data-sort="index_limit">期限</th>
    <th class="sort" data-sort="index_poster">投稿者</th>
    <th class="sort" data-sort="index_postdate">投稿日</th>
    <th class="sort" data-sort="index_tantou">担当</th>
  </tr>
</thead>
  <tbody class="list">
  @foreach ($tasks as $task)
  <tr>
    <td class="index_id"><a href="/tasks/tasks/show/{{$task -> id}}" class="btn btn-default btn-sm">{{$task -> id}}</a></td>

    @if($task['ステータス'] === '未対応')
    <td class="index_status"><a href="/tasks/tasks/edit/{{$task -> id}}" class="btn btn-default btn-sm"> {{$task -> ステータス}}</a></td>

    @elseif($task['ステータス'] === '対応中')
    <td class="index_status"><a href="/tasks/tasks/edit/{{$task -> id}}" class="btn btn-primary btn-sm">{{$task -> ステータス}}</a></td>

    @elseif($task['ステータス'] === '確認中')

      @if($task['report_flag'] == '1')
      <td class="index_status"><a href="/tasks/tasks/edit_report/{{$task -> id}}" class="btn btn-danger btn-sm">{{$task -> ステータス}}</a></td>
      @else
      <td class="index_status"><a href="/tasks/tasks/edit/{{$task -> id}}" class="btn btn-danger btn-sm">{{$task -> ステータス}}</a></td>
      @endif

      @elseif($task['ステータス'] === '報告中')
      <td class="index_status"><a href="/tasks/tasks/edit_report/{{$task -> id}}" class="btn btn-warning btn-sm">{{$task -> ステータス}}</a></td>

    @endif

    @if($task['優先度'] === '最優先')
    <td class="index_priority"><div class="font_red">{{$task -> 優先度}}</div></td>

    @elseif($task['優先度'] === '優先')
    <td class="index_priority"><div class="font_orange">{{$task -> 優先度}}</div></td>

    @else
    <td class="index_priority">{{$task -> 優先度}}</td>
    @endif

    <td class="index_customers">{{$task -> customer_name}}</td>
    <td class="index_category">{{$task -> category_name}}</td>
    <td class="index_title">{{$task -> 件名}}</td>
    <td class="index_contents">{!! mb_substr( $task['内容'],0,5) !!}</td>


	{{-- 現在が期限2日前ならオレンジ 過ぎたら赤--}}
	  @if($task['期限'] < $dt)
      <td class="index_limit"><div class="font_red">{{$task -> 期限}}</div></td>
    @elseif($task['期限']  < $dt2  )
      <td class="index_limit"><div class="font_orange">{{$task -> 期限}}</div></td>
    @else
      <td class="index_limit">{{$task-> 期限}}</td>
    @endif

    <td class="index_poster">{{$task -> 投稿}}</td>
    <td class="index_postdate">{{$task -> created_at}}</td>

    <td class="index_tantou"><a href="/tasks/tasks/change_t/{{$task -> id}}" class="btn btn-default btn-sm">{{$task -> member_name}}</a></td>

  </tr>
    @endforeach
  </tbody>
</table>
</div>


<div style="text-align:center">{{ $tasks->links() }}</div>

@endsection
