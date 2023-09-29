@extends('layouts.login')

@section('content')

      {!! Form::open(['url' => 'posts/create' ]) !!}
      <div class="form-group">
        <div class="user_icon">
          <img src= "{{ asset('storage/images/' .Auth::user()->images) }}" alt="アイコン" width="55" height="55">
        </div>
        {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか']) }}
        <button type="submit" class="btn btn-success pull-right"><img src="./images/post.png" alt="投稿ボタン"></button>
        </div>
      {!! Form::close() !!}

       <table class='table-hover'>
          @foreach ($timeline as $article)
            <tr>
              <td class="user_icon"><img src="{{asset('storage/images/' . $article->images)}}" alt="アイコン" width="55" height="55"></td>
              <td>{{ $article -> username }}</td>
              <td>{{ $article->posts }}</td>
              <td>{{ $article->created_at}}</td>
              @if ($article->user_id === Auth::user()->id)
              <td>
                <a href="/post/{{$article->user_id}}/update" class="btn btn-apply modalopen" data-toggle="modal" data-target="{{$article->id}}">
                <img src="{{asset('images/edit.png')}}" alt="編集ボタン"></a>
              </td>
              <td>
                <div class="trash_icon">
                <a href = "/post/{{$article->id}}/delete"onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')">
                <img src ="{{asset('images/trash.png')}}" alt="削除ボタン">
                <img src="{{asset('images/trash_h.png')}}" alt="削除ボタン">
                </a>
                </div>
              </td>
              @endif
            </tr>
            <!-- モーダルの中身 -->
      <div class="panel">
        <div class="modal fade" id="{{$article->id}}" tabindex="-1" role="dialog" aria-label ="close"><span aria-hidden="true"></span>
          <div class="modal-dialog">
            <div class="modal-content disable">
              <div class="modal-body">
                <form action="/post/{{$article->id}}/update" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <textarea class="form-control" id="message-text" name="upPost" maxlength="200">{{$article->posts}}</textarea>
                    <input type="image" src="{{asset('images/edit.png')}}">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
          @endforeach
        </table>


@endsection
