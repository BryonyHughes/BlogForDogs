@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')

<div class="row justify-content-center">
  <form method="POST" action="{{ route('comments.update',['id'=>$comment->id]) }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
         <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

         <div class="col-md-6">
             <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ $comment->body }}" required autocomplete="body" autofocus>

             @error('body')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>
     </div>
          <button type="submit" class="button is-link is-outlined">Save</button>
  </form>
</div>


@endsection
