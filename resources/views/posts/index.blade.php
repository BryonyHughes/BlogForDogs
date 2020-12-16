@extends('layouts.app')

@section('title','Posts')

@section('content')

  <p>Keep up to date on the latest posts:</p>

  <ul>
    @foreach ($posts as $post)
      <li><a href="{{ route('posts.show',['id'=> $post->id]) }} "> {{ $post->title }}</a></li>
    @endforeach

  </ul>
@endsection
