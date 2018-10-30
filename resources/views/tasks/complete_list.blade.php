@extends('layouts.master')

@section('content')

<form class="form-inline" action="{{url('/tasks/complete_list')}}">
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
            <label class="mgr10">検索(件名or内容)　</label>
            <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="">
            </div>
          </div>

      </div><!-- row -->

      <div style="margin-left: 20px; ">
    		<input type="submit" value="検索" class="btn btn-info">
    	</div>
  </div>
</form>

   <form class="form-inline" action="{{url('/tasks/excel')}}">
  <input type="submit" value="Excelダウンロード(全件)" class="btn btn-primary">
</form>


<div style="text-align:center">{{ $tasks->links() }}</div>

<div id="tasks_table">

<table class="table table-striped">
<thead>

  <tr>
    <th class="sort" data-sort="index_id">ID</th>
    <th class="sort" data-sort="index_customers">施設名</th>
    <th class="sort" data-sort="index_category">カテゴリ</th>
    <th class="sort" data-sort="index_title">件名</th>
    <th class="sort" data-sort="index_contents">内容</th>
    <th class="sort" data-sort="index_postdate">投稿日</th>
    <th class="sort" data-sort="index_poster">投稿者</th>
    <th class="sort" data-sort="index_last_confirmation">最終確認日</th>
  </tr>
</thead>
<tbody class="list">
  @foreach ($tasks as $task)
  <tr>
    <td class="index_id"><a href="/tasks/tasks/show/{{$task -> id}}" class="btn btn-default btn-sm">{{$task -> id}}</button></a></td>
    <td class="index_customers">{{$task -> customer_name}}</td>
    <td class="index_category">{{$task -> category_name}}</td>
    <td class="index_title">{{$task -> 件名}}</td>
    <td class="index_contents">{!! mb_substr( $task['内容'],0,5) !!}</td>
    <td class="index_postdate">{{$task -> created_at}}</td>
    <td class="index_poster">{{$task -> 投稿}}</td>
    <td class="index_last_confirmation">{{$task -> 最終確認日}}</td>
  </tr>
    @endforeach
  </tbody>
</table>

<div style="text-align:center">{{ $tasks->links() }}</div>

@endsection
