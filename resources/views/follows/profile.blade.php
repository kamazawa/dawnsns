@extends('layouts.login')
@section('content')

<h2 class="page-header">Name </h2>

@foreach ($timeline as $article)
    <image src= "{{asset('images/' . $article->images)}}" alt="アイコン">
  <table class='table-hover'>
      <tr>
        <td><img src="{{asset('images/' . $article->images)}}" alt="アイコン"></td>
        <td>{{ $article-> username }}</td>
        <td>{{ $article->posts }}</td>
        <td>{{ $article->created_at}}</td>
      </tr>
@endforeach
 </table>

@endsection
