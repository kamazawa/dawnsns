@extends('layouts.login')

@section('content')
  <form action="{{url('profile/update')}}" enctype="multipart/form-data" method="post">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
     </ul>
    </div>
    @endif
  <input type="hidden" name="id" value="{{ $user->id }}">
  <div class="user_icon">
   <img src= "{{ asset('storage/images/' .Auth::user()->images) }}" alt="アイコン"  width="55" height="55">
  </div>
 <div class="form-group">
  <label>UserName</label>
  <input type="text" name="username" value="{{ $user->username }}">
 </div>
 <div class="form-group">
  <label>MailAdress</label>
  <input type="text" name="mail" value="{{$user->mail}}">
 </div>
 <div class="form-group">
  <tr>
    <label>Password</label>
    <input type="text" name="password" value="{{$count}}" readonly>
  </tr>
 </div>
<div class="form-group">
  <label>new Password</label>
  <input type="password" name="new_password">
 </div>
 <div class="form-group">
  <label>Bio</label>
  <input type="text" name="bio" value="{{$user->bio}}">
 </div>
 <div class="form-group">
  <label>Icon Image</label>
  <input type="file" name="images">
 </div>
  <input type="submit" name="update" value="更新">
  </form>



@endsection
