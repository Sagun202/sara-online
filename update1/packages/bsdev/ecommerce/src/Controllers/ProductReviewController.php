<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\ProductReviewDataTable;
use Bsdev\Ecommerce\Models\ProductReview;
use Bsdev\Ecommerce\Requests\UpdateProductReviewRequest;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductReviewDataTable $dataTable)
    {
        return $dataTable->render('ecommerce::review.index');
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
    public function store(Request $request)
    {
        //
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
    public function edit(ProductReview $productReview)
    {

        return view('ecommerce::review.edit', compact('productReview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductReviewRequest $request, ProductReview $productReview)
    {
        try {
            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;

            $productReview->update($data);

            return redirect()->route('productreviews.index')->with('success', 'Successfully Updated!');
        } catch (\Exception $ex) {

            return redirect()->route('productreviews.index')->with('error', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReview $productReview)
    {
        try {

            $productReview->delete();

            return redirect()->route('productreviews.index')->with('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {

            return redirect()->route('productreviews.index')->with('error', 'Something went wrong');

        }
    }
}
