@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Create a Post') }}</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('posts.update',['id'=>$post->id]) }}" enctype="multipart/form-data">
                          @csrf
                           <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                              <div class="col-md-6">
                                  <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" required autocomplete="title" autofocus>

                                  @error('title')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="post" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                              <div class="col-md-6">
                                  <input id="post" type="text" class="form-control @error('post') is-invalid @enderror" name="post" value="{{ $post->post }}" required autocomplete="post">

                                  @error('post')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                                            <label for="post_image" class="col-md-4 col-form-label text-md-right"> Image</label>
                                            <div class="col-md-6">
                                                <input id="post_image" type="file" class="form-control" name="post_image" value="{{ $post->posts_image }}">
                                            </div>
                                        </div>

                      <button type="submit" class="button is-link is-outlined">Publish</button>

                      @if (Route::has('posts.index'))
                          <a class="btn btn-link" href="{{ route('posts.index') }}">
                              {{ __('Cancel') }}
                          </a>
                      @endif


                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @endsection
