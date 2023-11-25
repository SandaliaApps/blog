<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseCollection;
use App\Models\User;
use App\Models\Blog;
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

        if ($blogs->count() > 0) {
            $status = true;
            $message = 'Blog list fetched successfully';

        } else {
            $status = false;
            $message = 'Blog not found';
        }

        return new ResponseCollection($status, $message, $blogs);
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
            'tags' => 'required|string|max:200',
            'user_id' => 'required|int'
        ]);

        $blog->name = $request->name;
        $blog->body = $request->body;
        $blog->tags = $request->tags;
        $blog->user_id = $request->user_id;
        $blog->saveOrFail();

        if ($blog->count() > 0) {
            $status = true;
            $message = 'Blog created successfully';

        } else {
            $status = false;
            $message = 'Blog could not be created!';
        }

        return new ResponseCollection($status, $message, $blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        if ($blog->count() > 0) {
            $status = true;
            $message = 'Blog fetched successfully';

        } else {
            $status = false;
            $message = 'Blog not found!';
        }

        return new ResponseCollection($status, $message, $blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'tags' => 'required|string|max:200',
            'user_id' => 'required|int',
            'updated_by' => 'required|int'
        ]);

        $blog->name = $request->name;
        $blog->body = $request->body;
        $blog->tags = $request->tags;
        $blog->user_id = $request->user_id;
        $blog->updated_by = $request->updated_by;
        $blog->saveOrFail();

        if ($blog->count() > 0) {
            $status = true;
            $message = 'Blog Updated successfully';

        } else {
            $status = false;
            $message = 'Blog could not be updated!';
        }

        return new ResponseCollection($status, $message, $blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->deleteOrFail();

        return new ResponseCollection(true, "Blog deleted successfully!", []);
    }
}
