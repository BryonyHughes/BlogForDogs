@extends('layouts.app')

@section('title','Posts')

@section('content')

<a href="{{route('posts.create')}}">Click Here To Create A Post!</a>

<p>Keep up to date on the latest posts:</p>

@foreach ($posts as $post)
<a href="{{ route('posts.show',['id' => $post->id]) }}">
    <h1 class="title">{{ $post->title }}</h1>
  </a>
  <p><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</p>
  <p><b>By:</b> {{ $post->user->name }}</p>
  <p>{!! nl2br(e($post->post)) !!}</p>

 @if ($post->user_id == Auth::user()->id)
  <form method="post" action="{{ route('posts.destroy',['id'=>$post->id]) }}">
      @csrf @method('delete')
    <div class="field is-grouped">
      <div class="control">
        <button type="submit" class="button is-danger is-outlined">
          Delete
        </button>
      </div>
    </div>
  </form>
@endif
@endforeach

  <div class="d-flex justify-content-center">
    {!! $posts ?? ''->links() !!}
</div>
@endsection
