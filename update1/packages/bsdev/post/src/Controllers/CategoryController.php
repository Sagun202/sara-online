<?php

namespace Bsdev\Post\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Post\DataTables\CategoryDataTable;
use Bsdev\Post\Models\Category;
use Bsdev\Post\Requests\StoreCategoryRequest;
use Bsdev\Post\Requests\UpdateCategoryRequest;
use Bsdev\Post\Traits\FileUpload;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('post_view'), 403);


        return $dataTable->render('post::category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('post_create'), 403);


        return view('post::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        abort_if(!auth()->user()->can('post_create'), 403);


        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('category', $request->image);
            }

            Category::create($data);

            return redirect()->route('categories.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('categories.index')->with('error', 'Something went wrong!!');

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
    public function edit(Category $category)
    {
        abort_if(!auth()->user()->can('post_edit'), 403);


        return view('post::category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_if(!auth()->user()->can('post_update'), 403);


        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('category', $request->image);
            }

            $category->update($data);

            return redirect()->route('categories.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('categories.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!auth()->user()->can('post_delete'), 403);


        try {
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('categories.index')->with('error', 'Something went wrong!!');

        }

    }
}
