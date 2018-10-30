@extends('layouts.master')

@section('content')

<h3>ステータス変更
@if ($tasks->c_flag == '1')
  ：確認中→完了
@elseif($tasks->t_flag == '1')
  ：対応中→確認依頼
@else
  ：未対応→対応
@endif
</h3>


<form class="form-horizontal" method="post" action="/tasks/tasks/update/{{$tasks->id}}">

  <table class="table tables-bordered">

    <tr>
      <td class="success">ID</td>
      <td>{{$tasks['id']}}</td>
      <td class="success">ステータス</td>

      <td>
        <select name="ステータス" class="form-control">
        @if($tasks['ステータス'] === '未対応')
          <option value="未対応">未対応</option>
          <option value="対応中">対応中</option>
        @elseif($tasks['ステータス'] === '対応中')
          <option value="対応中">対応中</option>
          <option value="確認中">確認中</option>
        @elseif($tasks['ステータス'] === '確認中')
          <option value="確認中">確認中</option>
          <option value="完了">完了</option>
        @endif
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
          <td class="success">確認者</td>
          <td>

            @if ($tasks->t_flag == '1')
              <select name="c_member_name" class="form-control">
              <option value="{{$tasks->確認}}">{{$tasks->確認}}</option>
              @foreach ($members as $member)
              <option value="{{$member->member_name}}">{{$member->member_name}}</option>
              @endforeach
              </select>
            @else

            @endif

          </td>
          <td class="success">確認日</td><td>{{$tasks['最終確認日']}}</td>
        </tr>
      </table>



      <table class="table table-bordered">
        <tr>
          <td class="success">対応時のメモ</td>
          @if($tasks['t_flag'] == "1" && $tasks['c_flag'] == "0" )
            <td><textarea name="対応時のメモ" rows="3" class="form-control">{{$tasks->対応時のメモ}}</textarea></td>
          @else
          <td colspan="3">{!! nl2br(e( $tasks['対応時のメモ'])) !!}</td>
          @endif
        </tr>
        <tr>
          <td class="success">確認時のメモ</td>
          @if($tasks['c_flag'] == "1")
            <td><textarea name="確認時のメモ" rows="3" class="form-control">{{$tasks->確認時のメモ}}</textarea></td>
          @else
            <td colspan="3">{!! nl2br(e( $tasks['確認時のメモ'])) !!}</td>
          @endif
        </tr>
      </table>


  <input type="hidden" name="_token" value="{{csrf_token()}}">
 <div class="col-xs-offset-2 col-xs-10">
 <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
 </div>
</form>
@endsection
