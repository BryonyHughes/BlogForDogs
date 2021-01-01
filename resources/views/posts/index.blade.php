@extends('layouts.app')

@section('title','Posts')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>

<div class="row justify-content-center">
<div class="w3-col m7">



      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h1>Hello {{Auth::user()->name}} !</h1>
              <h6 class="w3-opacity">Keep up to date on the latest posts:</h6>
              <button type="button" class="w3-button w3-theme" ><i class="fa fa-pencil"></i><a href="{{route('posts.create')}}"> Click Here To Create A Post!</a></button>
            </div>
          </div>
        </div>
      </div>

@foreach ($posts as $post)

<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
  <span class="w3-right w3-opacity">{{ $post->created_at->diffForHumans() }}</span>

              <a  href="{{ route('comments.page',['id' => $post->id]) }}">
                <h1 class="title">{{ $post->title }}</h1><br>
              </a>
               <hr class="w3-clear">
                        <p><b>By:</b> {{ $post->user->name }}</p>
                        <p>{!! nl2br(e($post->post)) !!}</p>
                        @if ($post->image && File::exists(public_path("images/".$post->image)))
                          <img src="{{asset('images/'. $post->image)}}" style="height:106px;width:106px" class="w3-margin-bottom">

                          @foreach ($post->tags as $tag)
                              {{$tag->topic}}
                          @endforeach

                        @endif


                        @if ($post->user_id == Auth::user()->id || Auth::user()->profile_type == "App\AdminProfile")
                        <form method="post" action="{{ route('posts.destroy',['id'=>$post->id]) }}">
                          @csrf @method('delete')
                          <div class="field is-grouped">
                            <div class="control">
                              <button type="submit" class="btn btn-outline-danger">
                                Delete
                              </button>
                            </div>
                          </div>
                        </form>
                        <form action="{{ route('posts.edit',['id'=>$post->id]) }}">
                          @csrf
                          <div class="field is-grouped">
                            <div class="control">
                              <button type="submit" class="btn btn-outline-warning">
                                Edit
                              </button>
                            </div>
                          </div>
                        </form>
                        @endif
                      </div>
                @endforeach



  <div class="d-flex justify-content-center">
    {!! $posts ?? ''->links() !!}
</div>

</div>
</div>
@endsection
