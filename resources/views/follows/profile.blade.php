@extends('layouts.login')

@section('content')

  @foreach ($timeline as $article)
      <td><image src= "{{asset('images/' . $article->images)}}" alt="アイコン"></td>
      <td><h2 class="page-header">Name {{ $article -> username }}</h2></td>
      <td><h2 class="page-header">Bio</h2></td>
       @if ($is_following->contains($article->id))
        <td class="follow-button">
          <form action="/follow/{{ $article->id }}/unfollow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローをはずす" >
          </form>
      </td>
      @else
      <td class="unfollow-button">
          <form action="/follow/{{ $article->id }}/follow" method="post">
            @csrf
            <input type="submit" name= "button" value="フォローする" >
          </form>
        </td>

      @endif
    <table class='table-hover'>
      @isset($article->posts)
        <tr>
          <td><img src="{{asset('images/' . $article->images)}}" alt="アイコン"></td>
          <td>{{ $article-> username }}</td>
          <td>{{ $article->posts }}</td>
          <td>{{ $article->created_at}}</td>
        </tr>
      @endisset
    @endforeach
    </table>

@endsection
