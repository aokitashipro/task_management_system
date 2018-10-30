@extends('layouts.master')

@section('content')

<br>
<form class="form-horizontal" method="post" action="/tasks/tasks/update/{{$tasks['id']}}">

  <div class="form-group">
    <label class="control-label col-xs-2">ステータス</label>
    <div class="col-xs-9">
      <select name="ステータス" class="form-control">
      <option value="0">選択して下さい</option>
      <option value="1">対応中</option>
      <option value="2">確認中</option>
      <option value="3">承認中</option>
      <option value="4">最終確認中</option>
      <option value="5">完了</option>
    </select>
    </div>
  </div>

   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="更新" class="btn btn-primary">
  </div>
</form>
