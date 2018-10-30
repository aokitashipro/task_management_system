@extends('layouts.master')

@section('content')

@foreach ($tasks as $task)

<table class="table tables-bordered">

  <tr>
    <td class="success">ID</td>
    <td>{{$task['id']}}</td>
    <td class="success">ステータス</td>
    <td>{{$task -> ステータス}}</td>
  </tr>
  <tr>
    <td class="success">優先度</td>
    <td>{{$task -> 優先度}}</td>
    <td class="success">施設名</td>
    <td>{{$task -> 施設名}}</td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="success">カテゴリ</td>
    <td>{{$task -> カテゴリ}}</td>
    <td class="success">期限</td>
    <td>{{$task -> 期限}}</td>
  </tr>
</table>

<table class="table table-bordered">
  <tr>
    <td class="success">内容</td>
    <td colspan="3">{!! nl2br(e( $task -> 内容 )) !!} </td>
  </tr>
</table>

<table class="table table-bordered">
  <tr>
    <td class="success">投稿者</td><td>{{$task -> 投稿者}}</td>
    <td class="success">投稿日時</td><td>{{$task -> created_at}}</td>
  </tr>
  <tr>
    <td class="success">対応者</td><td>{{$task -> 対応者}}</td>
    <td class="success">対応日</td><td>{{$task -> 対応日}}</td>
  </tr>
  <tr>
    <td class="success">確認者</td><td>{{$task -> 確認者}}</td>
    <td class="success">確認日</td><td>{{$task -> 確認日}}</td>
  </tr>
  <tr>
    <td class="success">承認者</td><td>{{$task -> 承認者}}</td>
    <td class="success">承認日</td><td>{{$task -> 承認日}}</td>
  </tr>
  <tr>
    <td class="success">最終確認者</td><td>{{$task -> 最終確認者}}</td>
    <td class="success">最終確認日</td><td>{{$task -> 最終確認日}}</td>
  </tr>

</table>

@endforeach
