@extends('layouts.login')

@section('content')

      {!! Form::open(['url' => 'posts/create' ]) !!}
      <h2 class="page-header">新しく投稿する</h2>
      <div class="form-group">
        {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか']) }}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img src="./images/post.png" alt="投稿ボタン"></button>
      {!! Form::close() !!}

       <table class='table-hover'>
          @foreach ($timeline as $article)
            <tr>
              <td><img src="{{asset('images/' . $article->images)}}" alt="アイコン"></td>
              <td>{{ $article -> username }}</td>
              <td>{{ $article->posts }}</td>
              <td>{{ $article->created_at}}</td>
              @if ($article->user_id === Auth::user()->id)
              <td>
                <a href="/post/{{$article->user_id}}/update" class="btn btn-apply modalopen" data-toggle="modal" data-target="{{$article->id}}">
                <img src="{{asset('images/edit.png')}}" alt="編集ボタン"></a>
              </td>
              <td>
                <a href = "/post/{{$article->id}}/delete"onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="{{asset('images/trash.png')}}" alt="削除ボタン"></a>
              </td>
              @endif
            </tr>
            <!-- モーダルの中身 -->
        <div class="modal fade" id="{{$article->id}}" tabindex="-1" role="dialog" aria-label ="close"><span aria-hidden="true"></span>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="/post/{{$article->id}}/update" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <textarea class="form-control" id="message-text" name="upPost">{{$article->posts}}</textarea>
                    <input type="image" src="{{asset('images/edit.png')}}">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
          @endforeach
        </table>


@endsection
