@extends('layouts.login')

@section('content')

  <div id="search">
    <form action=" /user.search " method="post">
      @csrf
      <input type="text" name="keyword" value="{{ $keyword }}" placeholder="ユーザー名">
      <input type="submit" value="検索">
   </form>
  </div>

  <table class="table-list">
    @foreach ($userlist as $user)
    @if ($user->id !== Auth::user()->id)
      <tr>
        <td><img src="{{asset('images/' . $user->images)}}" alt="アイコン"></td>
        <td>{{ $user -> username }}</td>

        @if ($is_following->contains($user->id))
        <td class="follow-button">
          <form action="/users/{{ $user->id }}/unfollow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローをはずす" >
          </form>
      </td>
      @else
      <td class="unfollow-button">
          <form action="/users/{{ $user->id }}/follow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローする" >
          </form>
        </td>
      @endif
      </tr>
    @endif
    @endforeach
  </table>

@endsection
