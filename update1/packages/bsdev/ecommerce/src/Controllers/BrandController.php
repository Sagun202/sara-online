<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\BrandDataTable;
use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Requests\StoreBrandRequest;
use Bsdev\Ecommerce\Requests\UpdateBrandRequest;
use Bsdev\Theme\Traits\FileUpload;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use FileUpload;
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('brand_view'), 403);

        return $dataTable->render('ecommerce::brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('brand_create'), 403);

        return view('ecommerce::brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        abort_if(!auth()->user()->can('brand_create'), 403);

        try {
            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('brands', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $data['seo'] = $seo;
            $data['user_id'] = auth()->id();
            Brand::create($data);

            return redirect()->route('brands.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('brands.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

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
    public function edit(Brand $brand)
    {
        abort_if(!auth()->user()->can('brand_edit'), 403);

        return view('ecommerce::brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        abort_if(!auth()->user()->can('brand_update'), 403);

        try {
            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('brands', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $data['seo'] = $seo;
            $brand->update($data);

            return redirect()->route('brands.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('brands.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        abort_if(!auth()->user()->can('brand_delete'), 403);

        try {

            $brand->delete();

            return redirect()->route('brands.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('brands.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

        }
    }
}
