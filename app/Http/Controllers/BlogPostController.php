<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all blog posts
        $posts = BlogPost::all(); //fetch all blog posts from DB

        // return $posts; //returns the fetches posts
        return view('blog.index', [
            'posts'=> $posts,
        ]); //returns the view with posts
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show form to create a blog post
        return view('blog.create');

        // suraiya
        // if (Auth::check()) {
        //     return view('blog.create');
        //     // The user is logged in...
        // }
        // else {
        //     echo "Login First please!";
        // }
        // suraiya
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store a new post
        $newPost = BlogPost::create([
            'title'=> $request->title,
            'body'=> $request->body,
            $fileName = time().$request->file('photo')->getClientOriginalName(),
            $path = $request->file('photo')->storeAs('images', $fileName, 'public'),
            $requestData["photo"] = '/storage/'.$path,
            // 'user_id'=> 1,
            'user_id'=> Auth::id(),
        ]);

        return redirect('blog/' . $newPost->id)->with('flash_message', "Post created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //show a blog post
        // return $blogPost; //returns the fetched posts
        return view('blog.show', [
            'post'=> $blogPost,
        ]); // returns the view with the post
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        if(auth()->user()->id!=$blogPost->user_id){
            return redirect()->back();
        }
        //show form to edit the post
        return view('blog.edit', [
            'post' => $blogPost,
        ]); //returns the edit view with the post
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        //save the edited post
        $blogPost->update([
            'title'=> $request->title,
            'body'=>$request->body
        ]);

        return redirect('blog/' . $blogPost->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //delete a post
        $blogPost->delete();
        return redirect('/blog');
    }
}
