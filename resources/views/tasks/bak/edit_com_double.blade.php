@extends('layouts.master')

@section('content')

<h3>最終確認中(反映確認中) → 完了</h3>

<form class="form-horizontal" method="post" action="/tasks/tasks/update_com_double/{{$tasks->id}}">

  <table class="table tables-bordered">

    <tr>
      <td class="success">ID</td>
      <td>{{$tasks['id']}}</td>
      <td class="success">ステータス</td>

      <td>
          <select name="ステータス" class="form-control">
          <option value="5">最終確認中</option>
          <option value="6">完了</option>
      </td>

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
      <td>{{$tasks['カテゴリ']}}</td>
      <td class="success">期限</td>
      <td>{{$tasks['期限']}}</td>
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
      <td class="success">投稿者</td><td>{{$tasks['投稿者']}}</td>
      <td class="success">投稿日時</td><td>{{$tasks['created_at']}}</td>
    </tr>
    <tr>
      <td class="success">対応者</td>
      <td>
          {{$tasks['対応者']}}
      </td>
      <td class="success">対応日</td>
      <td>  {{$tasks['対応日']}}</td>
    </tr>

    <tr>
      <td class="success">確認者</td>
      <td>
            {{$tasks['確認者']}}
      </td>
      <td class="success">確認日</td><td>{{$tasks['確認日']}}</td>
    </tr>
    <tr>
      <td class="success">承認者</td><td>{{$tasks['承認者']}}</td>
      <td class="success">承認日</td><td>{{$tasks['承認日']}}</td>
    </tr>
    <tr>
      <td class="success">最終確認者</td>
      <td>{{$tasks['最終確認者']}}</td>
      <td class="success">最終確認日</td>
      <td>
        <input type="datetime_local" name="最終確認日" value="{!! date('Y/m/d H:i:s') !!}"></input></td>
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
      <td colspan="3"><textarea name="最終確認時のメモ" rows="5" class="form-control"></textarea>
      </td>
    </tr>


  </table>


   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
  </div>
</form>
@endsection
