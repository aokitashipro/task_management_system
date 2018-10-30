@extends('layouts.master')

@section('content')

<h3>ステータス変更：確認中→報告中→完了
</h3>


<form class="form-horizontal" method="post" action="/tasks/tasks/update_report/{{$tasks->id}}">

  <table class="table tables-bordered">

    <tr>
      <td class="success">ID</td>
      <td>{{$tasks['id']}}</td>
      <td class="success">ステータス</td>

      <td>
        <select name="ステータス" class="form-control">
          <option value="{{$tasks['ステータス']}}">{{$tasks['ステータス']}}</option>
          <option value="確認中">確認中</option>
          <option value="報告中">報告中</option>
          <option value="完了">完了</option>
        </select>
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
      <td>{{$tasks->category->category_name}}</td>
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
          <td class="success">担当者</td>

            <td>

             @if ($tasks->t_flag == '0')
              <select name="t_member_name" class="form-control">
                @if ($tasks->member_id == '0')

                @else
                  <option value="{{$tasks->担当}}">{{$tasks->担当}}</option>
                @endif

                @foreach ($members as $member)
                <option value="{{$member->member_name}}">{{$member->member_name}}</option>
                @endforeach

              </select>

             @else
                @if ($tasks->member_id == '0')
                @else
                {{$tasks->担当}}
                @endif
             @endif
            </td>

          <td class="success">対応日</td><td>{{$tasks['対応日']}}</td>
        </tr>

        <tr>
          <td class="success">確認者</td><td>{{$tasks->確認}}</td>
          <td class="success">確認日</td><td>{{$tasks['最終確認日']}}</td>
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
      </table>


  <input type="hidden" name="_token" value="{{csrf_token()}}">
 <div class="col-xs-offset-2 col-xs-10">
 <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
 </div>
</form>
@endsection
