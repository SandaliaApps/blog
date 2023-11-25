<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->is_admin === 1){

            $blogs = Blog::paginate(10);
        }else{
            $blogs = User::findOrFail(Auth()->user()->id)->blogs;
        }

        return view('blog.blogs',['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Blog();

        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'tags' => 'required|string|max:200'
        ]);

        $blog->name = $request->name;
        $blog->body = $request->body;
        $blog->tags = $request->tags;
        $blog->user_id = Auth()->user()->id;
        $blog->saveOrFail();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show',['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit',['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'tags' => 'required|string|max:200'
        ]);

        $blog->name = $request->name;
        $blog->body = $request->body;
        $blog->tags = $request->tags;
        $blog->updated_by = Auth()->user()->id;
        $blog->saveOrFail();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->deleteOrFail();

        return redirect()->route('blogs.index');
    }
}
