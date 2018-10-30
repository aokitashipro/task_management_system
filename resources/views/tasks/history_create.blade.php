@extends('layouts.master')

@section('content')

<form class="form-horizontal" method="post" action="/tasks/tasks/history_store">

  <div class="form-group">
    <label class="control-label col-xs-2">追加日</label>
    <div class="col-xs-9">
    <input type="datetime_local" name="追加日" value="{!! date('Y/m/d H:i:s') !!}" class="form-control"></input>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">バージョン</label>
    <div class="col-xs-9">
    <input type="text" name="バージョン" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">対応内容</label>
    <div class="col-xs-9">
    <input type="text" name="対応内容" class="form-control"></textarea>
    </div>
  </div>

   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="登録" class="btn btn-primary">
  </div>

</form>


@endsection
