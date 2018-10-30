@extends('layouts.master')

@section('content')

<h3>担当の変更</h3>

<form class="form-horizontal" method="post" action="/tasks/tasks/change_upload_t/{{$tasks->id}}">

  <div class="form-group">
    <label class="control-label col-xs-2">担当者の変更</label>
    <div class="col-xs-9">

      <select name="member_id" class="form-control">
        @foreach ($members as $member)
        <option value="{{$member->member_id}}">{{$member->member_name}}</option>
        @endforeach
      </select>

      </div>
    </div>


   <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="col-xs-offset-2 col-xs-10">
  <input type="submit" value="  更 新  " class="btn btn-lg btn-primary">
  </div>
</form>
@endsection
