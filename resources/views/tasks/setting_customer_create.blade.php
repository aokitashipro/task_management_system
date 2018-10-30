@extends('layouts.master')

@section('content')

<form class="form-horizontal" method="post" action="/tasks/tasks/setting_customer_store">

  <div class="form-group">
    <label class="control-label col-xs-2">顧客名</label>
    <div class="col-xs-9">
    <input type="text" name="customer_name" class="form-control"></textarea>
    </div>
  </div>

<input type="hidden" name="_token" value="{{csrf_token()}}">
 <div class="col-xs-offset-2 col-xs-10">
 <input type="submit" value="登録" class="btn btn-primary">
 </div>

</form>

@endsection
