<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');    //  $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts =  Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts/index')->with('posts', $posts);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title'=>'required', 'content'=>'required', 'cover_image'=>'image|nullable|max:1999']);

        // handle file upload
        if ($request->hasFile('cover_image')) {
            // obtain filename with the extension
            $filename_with_ext = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);  // raw PHP
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filename_to_save = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filename_to_save);
        } else {
            $filename_to_save = 'no_image';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filename_to_save;
        $post->save();
        return redirect('/home')->with('success', 'Post successfully created!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts/show')->with('post', $post);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);

        // verify it's the right user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/login')->with('error', 'Unauthorized!');
        }


        return view('posts/edit')->with('post', $post);

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
        $this->validate($request, ['title'=>'required', 'content'=>'required', 'cover_image'=>'image|nullable|max:1999']);

        // handle file upload
        if ($request->hasFile('cover_image')) {
            // obtain filename with the extension
            $filename_with_ext = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);  // raw PHP
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filename_to_save = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filename_to_save);
        }

        $post =  Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $filename_to_save;
        }
        $post->save();
        return redirect('/home')->with('success', 'Post successfully updated!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::find($id);

        // verify it's the right user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/login')->with('error', 'Unauthorized!');
        }

        // delete cover_image too
//        if ($post->cover_image != 'no_image') {
//            Storage::delete('/public/cover_images/'.$post->cover_image);
//        }

        $post->delete();
        return redirect('/home')->with('success', 'Post successfully deleted!');


    }
}
