@extends('layouts.login')

@section('content')
<div class="list">
<h1>Follow list</h1>
@foreach ($follows_image as $follows_image)
 <a href = "/follow-list/{{ $follows_image->id }}/profile">
    <image src= "{{asset('storage/images/' . $follows_image->images)}}" alt="アイコン" width="55" height="55"></a>
@endforeach
</div>
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
