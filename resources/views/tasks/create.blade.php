@extends('layouts.master')

@section('content')

@if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form class="form-horizontal" method="post" action="/tasks/tasks/store">

  <div class="form-group">
    <label class="control-label col-xs-2">施設名</label>
    <div class="col-xs-9">
      <select name="customer_id" class="form-control">
      @foreach ($customers as $customer)
      <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
      @endforeach
      </select>

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">カテゴリ</label>
    <div class="col-xs-9">

      <select name="category_id" class="form-control">
      @foreach ($categories as $category)
      <option value="{{$category->category_id}}">{{$category->category_name}}</option>
      @endforeach
      </select>

      <!-- <select name="カテゴリ" class="form-control">
        <option value="0">選択して下さい</option>
        <option value="1">01_プラン作成</option>
        <option value="2">02_料金設定</option>
        <option value="3">03_期間延長</option>
        <option value="4">04_OTA関連</option>
        <option value="5">05_画像関連</option>
        <option value="6">06_HP関連</option>
        <option value="7">07_資料作成</option>
        <option value="8">08_集計</option>
        <option value="9">09_その他</option>
      </select> -->

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">件名</label>
    <div class="col-xs-9">
    <input type="text" name="件名" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">内容</label>
    <div class="col-xs-9">
    <textarea name="内容" rows="8" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">優先度</label>
    <div class="col-xs-9">
      <select name="優先度" class="form-control">
        <option value="1">標準</option>
        <option value="2">優先</option>
        <option value="3">最優先</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-2">期限</label>
    <div class="col-xs-9">
    <input type="datetime_local" name="期限" value="{!! date('Y/m/d H:i:s') !!}" class="form-control"></input>
    </div>
  </div>

    <div class="form-group">
      <label class="control-label col-xs-2">対応者</label>
      <div class="col-xs-9">

        <select name="member_id" class="form-control">
        @foreach ($members as $member)
        <option value="{{$member->member_id}}">{{$member->member_name}}</option>
        @endforeach
        </select>

        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-xs-2">投稿者</label>
        <div class="col-xs-9">
          <input type="text" name="投稿" value="{{ Auth::user()->name }}">
        </input>
        </div>
        </div>

   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="登録" class="btn btn-primary">
  </div>

</form>


@endsection
