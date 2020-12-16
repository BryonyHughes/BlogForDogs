@extends('layouts.app')

@section('title','Post Details')

@section('content')

  <ul>
      <li>Title: {{$post->title}}</li>
      <li>Content: {{$post->post}}</li>
      <li>Written by: {{$post->user->name}}</li>
  </ul>

@endsection
