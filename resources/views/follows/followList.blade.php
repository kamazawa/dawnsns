@extends('layouts.login')

@section('content')
<h2 class="page-header">Follow list</h2>
@foreach ($timeline as $article)
    <a href = "/follow-list/{{ $article->id }}/profile">
    <image src= "{{asset('images/' . $article->images)}}" alt="アイコン"></a>
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
