<?php

namespace Bsdev\Post\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Post\DataTables\PostCommentDataTable;
use Bsdev\Post\Models\PostComment;
use Bsdev\Post\Requests\StorePostCommentRequest;
use Bsdev\Post\Requests\UpdatePostCommentRequest;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostCommentDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('post_view'), 403);

        return $dataTable->render('post::postcomment.index');
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
    public function store(StorePostCommentRequest $request)
    {
        abort_if(!auth()->user()->can('post_create'), 403);

        try {
            $data = $request->validated();
            PostComment::create($data);
            return redirect()->back()->with('success', 'Successfully Created');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        // return view('post::postcomment.edit',compact('postComment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postcomment)
    {
        abort_if(!auth()->user()->can('post_edit'), 403);

        return view('post::postcomment.edit', compact('postcomment'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostCommentRequest $request, PostComment $postcomment)
    {
        abort_if(!auth()->user()->can('post_update'), 403);

        try {

            $data = $request->validated();

            $postcomment->update($data);

            return redirect()->route('postcomment.index')->with('success', 'Successfully Updated');

        } catch (\Exception $ex) {

            return redirect()->route('postcomment.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        abort_if(!auth()->user()->can('post_delete'), 403);

        try {

            $postComment->delete();

            return redirect()->route('postcomment.index')->with('success', 'Successfully deleted');

        } catch (\Exception $ex) {

            return redirect()->route('postcomment.index')->with('error', 'Something went wrong!!');

        }

    }
}
