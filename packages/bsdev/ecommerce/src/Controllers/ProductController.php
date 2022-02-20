<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\ProductDataTable;
use Bsdev\Ecommerce\Imports\ProductsImport;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\CustomField;
use Bsdev\Ecommerce\Models\Product;
use Bsdev\Ecommerce\Requests\StoreProductRequest;
use Bsdev\Ecommerce\Requests\UpdateProductRequest;
use Bsdev\Theme\Traits\FileUpload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('product_view'), 403);

        return $dataTable->render('ecommerce::product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('product_create'), 403);

        return view('ecommerce::product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        abort_if(!auth()->user()->can('product_create'), 403);
        try {
            beginTransaction();
            $data = $request->validated();
            if ($request->thumbnail) {
                $data['thumbnail'] = $this->uploadFile('products', $request->thumbnail);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            if ($request->tags) {
                $tags = $request->tags;
                $data['tags'] = $tags;

            }
            $custom_fields = [];
            if ($request->field) {
                foreach ($request->field as $key => $field) {
                    $custom_field = CustomField::find($key);
                    if ($custom_field->type == "file") {
                        $custom_fields[$key] = $this->uploadFile('field', $field);
                    } elseif ($custom_field->type == "checkbox") {
                        $custom_fields[$key] = $field;
                    } else {
                        $custom_fields[$key] = $field;
                    }
                }
            }

            $data['custom_fields'] = $custom_fields;

            $data['seo'] = $seo;

            if (!$request->images) {
                $images = [];
                $data['images'] = $images;
            }
            $data['user_id'] = auth()->id();
            $data['sku'] = \Illuminate\Support\Str::random(15);

            $product = Product::create($data);
            $product->categories()->sync($request->categories);
            if (isset($request->attribute_ids) && count(json_decode($request->attribute_ids)) > 0) {
                $product->has_variation = 1;
                $product->attribute_ids = json_decode($request->attribute_ids);
                $product->save();
                foreach (array_values(json_decode($request->variations, true)) as $variation) {
                    $variation['discount'] = 0;
                    $variation['in_stock'] = 1;
                    $product->variations()->create($variation);
                }

            } else {
                $product->attribute_ids = [];
                $product->has_variation = 0;
                $product->save();

            }

            commitTransaction();

            if ($request->expectsJson()) {

                return response()->json(['message' => 'success', 'url' => route('products.index')]);

            }
            return redirect()->route('products.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            rollbackTransaction();

            if ($request->expectsJson()) {

                return response()->json(['message' => 'error' . $ex->getMessage(), 'url' => route('products.index')], 500);
            }
            return redirect()->route('products.index')->with('error', 'Somethine went wrong!!' . $ex->getMessage());

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
    public function edit(Product $product)
    {
        abort_if(!auth()->user()->can('product_edit'), 403);

        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $product->user_id != auth()->id()) {

            abort(404);
        }

        return view('ecommerce::product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        abort_if(!auth()->user()->can('product_update'), 403);
        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $product->user_id != auth()->id()) {

            abort(404);
        }
        try {
            beginTransaction();
            $data = $request->validated();
            if ($request->thumbnail) {
                $data['thumbnail'] = $this->uploadFile('products', $request->thumbnail);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $tags = [];
            if ($request->tags) {
                $tags = $request->tags;

            }
            $data['tags'] = $tags;
            $custom_fields = [];
            if ($request->field) {
                foreach ($request->field as $key => $field) {
                    $custom_field = CustomField::find($key);
                    if ($custom_field->type == "file") {
                        if (is_string($field)) {

                            $custom_fields[$key] = $field;

                        } else {

                            $custom_fields[$key] = $this->uploadFile('field', $field);

                        }
                    } elseif ($custom_field->type == "checkbox") {
                        $custom_fields[$key] = $field;
                    } else {
                        $custom_fields[$key] = $field;
                    }
                }
            }
            $data['custom_fields'] = $custom_fields;

            $data['seo'] = $seo;

            if (!$request->images) {
                $images = [];
                $data['images'] = $images;
            }
            // $data['user_id'] = auht()->id;
            $product->update($data);

            if (isset($request->attribute_ids) && count(json_decode($request->attribute_ids)) > 0) {
                $product->has_variation = 1;
                $product->attribute_ids = json_decode($request->attribute_ids);
                $product->save();

                foreach (array_values(json_decode($request->variations, true)) as $variation) {
                    $varArray['id'] = $variation['id'];
                    unset($variation['id']);

                    $product->variations()->updateOrCreate($varArray, $variation);
                }

            } else {
                $product->attribute_ids = [];
                $product->has_variation = 0;
                $product->save();
                $product->variations()->delete();

            }

            $product->categories()->sync($request->categories);

            commitTransaction();

            if ($request->expectsJson()) {

                return response()->json(['message' => 'success', 'url' => route('products.index')]);

            }

            return redirect()->route('products.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            rollbackTransaction();

            if ($request->expectsJson()) {

                return response()->json(['message' => 'error' . $ex->getMessage(), 'url' => route('products.index')], 500);

            }

            return redirect()->route('products.index')->with('error', 'Somethine went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        abort_if(!auth()->user()->can('product_delete'), 403);
        if (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin') && $product->user_id != auth()->id()) {

            abort(404);
        }
        try {

            $product->delete();

            return redirect()->route('products.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('products.index')->with('error', 'Somethine went wrong!!');

        }
    }

    public function ajaxImageUpload(Request $request)
    {
        return $this->uploadFile('products', $request->file);
    }

    public function getCustomField(Request $request)
    {
        $categories = $request->categories;
        $categories = Category::find($categories);
        $fields = [];
        foreach ($categories as $category) {
            foreach ($category->custom_fields()->where('status', 1)->get() as $field) {
                if (!in_array($field->id, $fields)) {
                    $fields[] = $field->id;
                }
            }
        }
        $fields = CustomField::find($fields);
        $old = $request->old;
        $view = view('ecommerce::product.custom-field', compact('fields', 'old'))->render();
        return response()->json(['view' => $view]);

    }
    public function getBulkImport()
    {
        return view('ecommerce::product.bulk-import');
    }
    public function bulkImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);
        try {

            Excel::import(new ProductsImport, $request->file('file'));

        } catch (Execption $e) {

            return redirect()->back()->with('error', 'Someting went wrong!! contact developer');

        }
        return redirect()->route('products.index')->with('success', 'Successfully Imported');
    }
}
