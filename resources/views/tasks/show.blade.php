@extends('layouts.master')

@section('content')

<table class="table tables-bordered">

  <tr>
    <td class="success">ID</td>
    <td>{{$tasks['id']}}</td>
    <td class="success">ステータス</td>
    <td>{{$tasks['ステータス']}}</td>
  </tr>
  <tr>
    <td class="success">優先度</td>
    <td>{{$tasks['優先度']}}</td>
    <td class="success">施設名</td>
      <td>{{$tasks->customer->customer_name}}</td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="success">カテゴリ</td>
    <td>{{$tasks->category->category_name}}</td>
    <td class="success">期限</td>

    {{-- 現在時刻が期限より2日前ならオレンジ 期限過ぎなら赤 --}}
  @if ($tasks['ステータス'] == "完了")
    <td>{{$tasks-> 期限}}</td>
  @else
    @if($tasks['期限'] <  $dt )
      <td><div class="font_red">{{$tasks -> 期限}} </div></td>
    @elseif ($tasks['期限'] < $dt2)
      <td><div class="font_orange">{{$tasks -> 期限}}</div></td>
    @else
      <td>{{$tasks-> 期限}}</td>
    @endif
  @endif
  </tr>
</table>


<table class="table table-bordered">
  <tr>
    <td class="success">件名</td>
    <td>{{$tasks['件名']}} </td>
  </tr>
  <td class="success">内容</td>
    <!-- <td colspan="3">{!! nl2br(e( $tasks -> 内容 )) !!} </td> -->
  <td colspan="3">{!! nl2br(e( $tasks['内容'])) !!} </td>

  </tr>
</table>

<table class="table table-bordered">
  <tr>
    <td class="success">投稿者</td><td>{{$tasks['投稿']}}</td>
    <td class="success">投稿日時</td><td>{{$tasks['created_at']}}</td>
  </tr>
  <tr>
    <td class="success">担当者</td><td>{{$tasks['担当']}}</td>
    <td class="success">対応日</td><td>{{$tasks['対応日']}}</td>
  </tr>
  <tr>
    <td class="success">確認者</td><td>{{$tasks['確認']}}</td>
    <td class="success">最終確認日</td><td>{{$tasks['最終確認日']}}</td>
  </tr>
</table>


<table class="table table-bordered">
  <tr>
    <td class="success">対応時のメモ</td>
    <td colspan="3">{!! nl2br(e( $tasks['対応時のメモ'])) !!}</td>
  </tr>
  <tr>
    <td class="success">確認時のメモ</td>
    <td colspan="3">{!! nl2br(e( $tasks['確認時のメモ'])) !!}</td>
  </tr>
</table>

@if ($tasks['ステータス'] == "完了")

@else
<div clsss="row clear mgb20">
  <div class="col-xs-2">
    <a href="/tasks/tasks/edit_full/{{$tasks['id']}}" class="btn btn-info">編集</a>
  </div>
  <div class="col-xs-2">
    <form action="{{ action('TasksController@destroy', $tasks->id) }}" id="delete_{{ $tasks->id }}" method="post">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <a href="#" data-id="{{ $tasks->id }}" class="btn btn-danger" onclick="deletePost(this);">削除</a>
      </form>
  </div>
</div>


@endif

<script>
<!--
/************************************
 削除ボタンを押してすぐにレコードが削除
 されるのも問題なので、一旦javascriptで
 確認メッセージを流します。
*************************************/
//-->
function deletePost(e) {
  'use strict';

  if (confirm('本当に削除していいですか?')) {
  document.getElementById('delete_' + e.dataset.id).submit();
  }
}
</script>

@endsection
