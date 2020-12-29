<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\Comment;
use App\Notifications\CommentPosted;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Posts, ordered by the newest first
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        return view('posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'title'=>'required|max:255',
          'post'=>'required',
        ]);

        $p  = new Post;
        $p->title = $validatedData['title'];
        $p->post = $validatedData['post'];
        $p->user_id = auth()->user()->id;

        if ($request->hasFile('post_image')){
          $imageName = time().'.'.$request->post_image->extension();
          $request->post_image->move(public_path('images'), $imageName);
          $p->image = $imageName;
        }

        $p->save();

        session()->flash('message','Posted!');
        return redirect()->route('posts.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', '=', $id)->paginate(10);
        return view('posts.show')->with(array('post'=>$post,'comments'=>$comments));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post=Post::findOrFail($id);
      $post->delete();

      return redirect()->route('posts.index')->with('message','Post was deleted!');
    }



}
