<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\CategoryDataTable;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Requests\StoreCategoryRequest;
use Bsdev\Ecommerce\Requests\UpdateCategoryRequest;
use Bsdev\Theme\Traits\FileUpload;
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
        abort_if(!auth()->user()->can('category_view'), 403);

        return $dataTable->render('ecommerce::category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('category_create'), 403);

        return view('ecommerce::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        abort_if(!auth()->user()->can('category_create'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('category', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            if (!$request->position) {
                $data['position'] = 1;
            }
            $data['seo'] = $seo;
            $data['user_id'] = auth()->id();

            Category::create($data);

            return redirect()->route('product.categories.index')->with('success', 'Successfully Created');

        } catch (\Exception $ex) {

            return redirect()->route('product.categories.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

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
        abort_if(!auth()->user()->can('category_edit'), 403);

        return view('ecommerce::category.edit', compact('category'));
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
        abort_if(!auth()->user()->can('category_update'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('category', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $data['seo'] = $seo;
            if (!$request->position) {
                $data['position'] = 1;
            }
            $category->update($data);

            return redirect()->route('product.categories.index')->with('success', 'Successfully Updated');

        } catch (\Exception $ex) {

            return redirect()->route('product.categories.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

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
        abort_if(!auth()->user()->can('category_delete'), 403);

        try {

            $category->delete();

            return redirect()->route('product.categories.index')->with('success', 'Successfully Deleted');

        } catch (\Exception $ex) {

            return redirect()->route('product.categories.index')->with('error', 'Something went wrong!!');

        }
    }
}
