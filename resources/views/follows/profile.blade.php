@extends('layouts.login')

@section('content')
<tr>
 <div class="user_icon"><image src= "{{asset('storage/images/' . $user_prof->images)}}" alt="アイコン" width="55" height="55"></div>
 <td><p>Name {{ $user_prof->username }} </p></td>
 <td><p>Bio
  @isset($user_prof->bio)
  {{ $user_prof->bio }}
        @endisset
 </p></td>
</tr>
      @if ($is_following->contains($user_prof->id))
        <td class="follow-button">
          <form action="/follow/{{ $user_prof->id }}/unfollow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローをはずす" >
          </form>
      </td>
      @else
      <td class="unfollow-button">
          <form action="/follow/{{ $user_prof->id }}/follow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローする" >
          </form>
        </td>
      @endif

  @foreach ($timeline as $article)

    <table class='table-hover'>
      @isset($article->posts)
        <tr>
          <td class="user_icon"><img src="{{asset('storage/images/' . $article->images)}}" alt="アイコン" width="55" height="55"></td>
          <td>{{ $article-> username }}</td>
          <td>{{ $article->posts }}</td>
          <td>{{ $article->created_at}}</td>
        </tr>
      @endisset
    @endforeach
    </table>

@endsection
