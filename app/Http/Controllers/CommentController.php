<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Comment;
use App\Post;
use App\User;
use Auth;
use App\Notifications\CommentPosted;






class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::findOrFail($id);
      return view('comments.edit')->with(array('comment'=>$comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $comment = Comment::findOrFail($id);
          $comment->body = $request->body;
          $comment->save();

          
          return redirect()->route('posts.index')->with('message','Comment updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment=Comment::findOrFail($id);
      $post = Post::where('comment_id', '=', $id);

      $comment->delete();

      return redirect()->route('posts.index')->with('message','Comment was deleted!');
    }

    public function page($id)
    {
      $post = Post::findOrFail($id);
      $comments = Comment::where('post_id', '=', $id);
    //  return view('comments.index')->with('post'=>$post);
    //  return view('comments.index',['post' => $post]);
    return view('comments.index')->with(array('post'=>$post,'comments'=>$comments));
    }

    public function apiIndex($id) //Post $post
    {
       $post = Post::findOrFail($id);
       $comments = Comment::where('post_id', '=', $id);
      //return view('posts.show')->with(array('post'=>$post,'comments'=>$comments));

        //$post = Post::findOrFail($id);
      //  $comments = Comment::where('post_id', '=', $id)->paginate(10);
      //  return view('comments.index')->with(array('post'=>$post,'comments'=>$comments));
    // $comments = Comment::all();
     return $comments;
    }

    public function apiStore(Request $request,$id) //Post $post_id)
    {
      $validatedData = $request->validate([
        'body'=>'required',
      ]);

      $post =Post::findOrFail($id);

      $c  = new Comment;
      $c->body = $validatedData['body'];
      $c->post_id = $post->id;
      $c->user_id = auth()->user()->id;
      $c->save();
      $user = auth()->user();

      $post->user->notify(new CommentPosted($post, $user));

      return response($c);

    //  return view('posts.show')->with(array('post'=>$post,'comments'=>$c));
    }




}
