@extends('layouts.master')

@section('content')

表示は1、非表示は0になります。<br>


<h3>顧客一覧</h3>

<button><a href="/tasks/tasks/setting_customer_create">顧客追加</a></button>
<table class="table table-striped">
  <tr>
    <th>顧客id</th>
    <th>顧客名</th>
    <th>表示/非表示</th>
  </tr>

  @foreach ($customers as $customer)
  <tr>
    <td class="index_id">
<a href="/tasks/tasks/setting_customer_update/{{$customer -> id}}" class="btn btn-default btn-sm">{{$customer -> customer_id}}</a>
</td>
    <td>{{$customer->customer_name}}</td>
    <td>{{$customer->visible_flag}}</td>
  </tr>
  @endforeach
</table>

<h3>カテゴリー一覧</h3>

<button><a href="/tasks/tasks/setting_category_create">カテゴリー追加</a></button>
<table class="table table-striped">
  <tr>
    <th>カテゴリーid</th>
    <th>カテゴリー名</th>
    <th>表示/非表示</th>
  </tr>

  @foreach ($categories as $category)
  <tr>
    <td class="index_id">
<a href="/tasks/tasks/setting_category_update/{{$category -> id}}" class="btn btn-default btn-sm">{{$category -> category_id}}</a>
</td>
    <td>{{$category->category_name}}</td>
    <td>{{$category->visible_flag}}</td>
  </tr>
  @endforeach
</table>

<h3>担当者一覧</h3>

<button><a href="/tasks/tasks/setting_member_create">担当者追加</a></button>
<table class="table table-striped">
  <tr>
    <th>担当者id</th>
    <th>担当者名</th>
    <th>表示/非表示</th>
  </tr>

  @foreach ($members as $member)
  <tr>
    <td class="index_id">
<a href="/tasks/tasks/setting_member_update/{{$member -> id}}" class="btn btn-default btn-sm">{{$member -> member_id}}</a>
</td>
    <td>{{$member->member_name}}</td>
    <td>{{$member->visible_flag}}</td>
  </tr>
  @endforeach
</table>

@endsection
