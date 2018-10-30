@extends('layouts.master')

@section('content')
<h3>更新リスト</h3>

<div style="text-align:center">{{ $histories->links() }}</div>

<table class="table table-striped">
  <tr>
    <th>No.</th>
    <th>追加日</th>
    <th>バージョン</th>
    <th>対応内容</th>
  </tr>

  @foreach ($histories as $history)
  <tr>
    <td>{{$history ->id}}</td>
    <td>{{$history ->追加日}}</td>
    <td>{{$history ->バージョン}}</td>
    <td>{{$history ->対応内容}}</td>
  </tr>
  @endforeach
</table>

<div style="text-align:center">{{ $histories->links() }}</div>

<button><a href="/tasks/tasks/history_create">追加</a></button>


<!--ここをコピーして追加
 <tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
-->

@endsection
