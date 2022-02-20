<?php

namespace Bsdev\Post\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Post\DataTables\PostDataTable;
use Bsdev\Post\Models\Post;
use Bsdev\Post\Requests\StorePostRequest;
use Bsdev\Post\Requests\UpdatePostRequest;
use Bsdev\Post\Traits\FileUpload;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('post_view'), 403);

        return $dataTable->render('post::post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('post_create'), 403);

        return view('post::post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        abort_if(!auth()->user()->can('post_create'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('post', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }

            $data['seo'] = $seo;

            if ($request->gallery) {
                $data['gallery'] = $request->gallery;
            } else {
                $data['gallery'] = [];
            }
            $data['user_id'] = auth()->user()->id;
            $post = Post::create($data);

            $post->categories()->sync($request->categories);

            return redirect()->route('posts.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('posts.index')->with('error', 'Something went wrong!!');

        }
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
    public function edit(Post $post)
    {
        abort_if(!auth()->user()->can('post_edit'), 403);

        return view('post::post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        abort_if(!auth()->user()->can('post_update'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('post', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            if ($request->gallery) {
                $data['gallery'] = $request->gallery;
            } else {
                $data['gallery'] = [];
            }

            $data['seo'] = $seo;

            $post->update($data);

            $post->categories()->sync($request->categories);

            return redirect()->route('posts.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('posts.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_if(!auth()->user()->can('post_delete'), 403);

        try {

            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('posts.index')->with('error', 'Something went wrong!!');

        }
    }

    public function uploadFileAjax(Request $request)
    {
        return $this->uploadFile('post', $request->file);
    }
}
