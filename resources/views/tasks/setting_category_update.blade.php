@extends('layouts.master')

@section('content')

<h3>カテゴリー内容の更新</h3>

<form class="form-horizontal" method="post" action="/tasks/tasks/setting_category_changed/{{$categories->id}}">

  <div class="form-group">
    <label class="control-label col-xs-2">カテゴリーの変更</label>

    <table class="table table-bordered">
      <tr>
        <td class="success">カテゴリーID</td>
        <td>
        {{$categories['categories_id']}}
        </td>
      </td>
      </tr>

      <tr>
        <td class="success">カテゴリー名</td>
        <td>
        <input type="text" name="category_name" class="form-control" value="{{$categories['category_name']}}">
      </td>
      </tr>

      <tr>
        <td class="success">表示(1)/非表示(0)</td>
        <td>
        <input type="text" name="visible_flag" class="form-control" value="{{$categories['visible_flag']}}">
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
