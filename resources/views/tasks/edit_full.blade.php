@extends('layouts.master')

@section('content')

 <form method="post" action="/tasks/tasks/update_full/{{$tasks->id}}">

<table class="table tables-bordered">

  <tr>
    <td class="success">ID</td>
    <td>{{$tasks['id']}}</td>
    <td class="success">ステータス</td>
    <td>{{$tasks['ステータス']}}</td>
  </tr>
  <tr>
    <td class="success">優先度</td>
    <td>
      <select name="優先度" value="{{$tasks->優先度}}" class="form-control">
        @if($tasks['優先度'] == "標準")
          <option value="0">優先度を選んでください</option>
          <option value="1" selected>標準</option>
          <option value="2">優先</option>
          <option value="3">最優先</option>
        @elseif ($tasks['優先度'] == "優先")
          <option value="0">優先度を選んでください</option>
          <option value="1">標準</option>
          <option value="2" selected>優先</option>
          <option value="3">最優先</option>
        @else
          <option value="0">優先度を選んでください</option>
          <option value="1">標準</option>
          <option value="2">優先</option>
          <option value="3" selected>最優先</option>
        @endif
      </select>
    </td>
    <td class="success">施設名</td>
      <td>{{$tasks->customer->customer_name}}</td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="success">カテゴリ</td>
    <td>{{$tasks['カテゴリ']}}</td>
    <td class="success">期限</td>
    <td>
      <input type="text" name="期限" value="{{$tasks->期限}}" class="form-control">
    </td>

  </tr>
</table>


<table class="table table-bordered">
  <tr>
    <td class="success">件名</td>
    <td>
      <input type="text" name="件名" value="{{$tasks->件名}}" class="form-control">
    </td>
  </tr>
  <td class="success">内容</td>
    <!-- <td colspan="3">{!! nl2br(e( $tasks -> 内容 )) !!} </td> -->
<!--  <td colspan="3">{!! nl2br(e( $tasks['内容'])) !!} </td> -->
  <td colspan="3">

    <textarea name="内容" rows="8" class="form-control">{{$tasks->内容}}</textarea>

  </tr>
</table>

<table class="table table-bordered">
  <tr>
    <td class="success">投稿者</td><td>{{$tasks['投稿者']}}</td>
    <td class="success">投稿日時</td><td>{{$tasks['created_at']}}</td>
  </tr>
  <tr>
    <td class="success">対応者</td><td>{{$tasks['対応者']}}</td>
    <td class="success">対応日</td><td>{{$tasks['対応日']}}</td>
  </tr>
  <tr>
    <td class="success">確認者</td><td>{{$tasks['確認者']}}</td>
    <td class="success">確認日</td><td>{{$tasks['確認日']}}</td>
  </tr>
  <tr>
    <td class="success">承認者</td><td>{{$tasks['承認者']}}</td>
    <td class="success">承認日</td><td>{{$tasks['承認日']}}</td>
  </tr>
  <tr>
    <td class="success">最終確認者</td><td>{{$tasks['最終確認者']}}</td>
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
  <tr>
    <td class="success">承認時のメモ</td>
    <td colspan="3">{!! nl2br(e( $tasks['承認時のメモ'])) !!}</td>
  </tr>
  <tr>
    <td class="success">最終確認時のメモ</td>
    <td colspan="3">{!! nl2br(e( $tasks['最終確認時のメモ'])) !!}</td>
  </tr>
</table>


  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
  </div>
</form>

@endsection
