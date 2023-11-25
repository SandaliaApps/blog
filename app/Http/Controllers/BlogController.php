<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->is_admin === 1){

            $blogs = Blog::paginate(10);
        }

        $blogs = User::findOrFail(Auth()->user()->id)->blogs;

        return view('blog.blogs',['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'body' => 'required|string|max:1000',
                'tags' => 'required|string|max:200'
            ]);

            $blog = new Blog();

            $blog->name = $request->name;
            $blog->body = $request->body;
            $blog->tags = $request->tags;
            $blog->user_id = Auth::user()->id;

            DB::rollBack();

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        try {
            
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'body' => 'required|string|max:1000',
                'tags' => 'required|string|max:200'
            ]);

            $blog->name = $request->name;
            $blog->body = $request->body;
            $blog->tags = $request->tags;
            $blog->updated_by = Auth::user()->id;

            DB::rollBack();

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    }
}
