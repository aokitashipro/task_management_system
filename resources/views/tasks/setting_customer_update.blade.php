@extends('layouts.master')

@section('content')

<h3>顧客内容の更新</h3>

<form class="form-horizontal" method="post" action="/tasks/tasks/setting_customer_changed/{{$customers->id}}">

  <div class="form-group">
    <label class="control-label col-xs-2">顧客情報の変更</label>

    <table class="table table-bordered">
      <tr>
        <td class="success">顧客ID</td>
        <td>
        {{$customers['customer_id']}}
        </td>
      </td>
      </tr>

      <tr>
        <td class="success">顧客名</td>
        <td>
        <input type="text" name="customer_name" class="form-control" value="{{$customers['customer_name']}}">
      </td>
      </tr>

      <tr>
        <td class="success">表示(1)/非表示(0)</td>
        <td>
        <input type="text" name="visible_flag" class="form-control" value="{{$customers['visible_flag']}}">
        </td>
      </tr>
    </table>

    </div>

   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
  </div>
</form>
@endsection
