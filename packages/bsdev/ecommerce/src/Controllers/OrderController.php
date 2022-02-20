<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\OrderDataTable;
use Bsdev\Ecommerce\Models\Order;
use Bsdev\Ecommerce\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('order_view'), 403);

        return $dataTable->render('ecommerce::order.index');
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
    public function edit(Order $order)
    {
        abort_if(!auth()->user()->can('order_edit'), 403);

        return view('ecommerce::order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        abort_if(!auth()->user()->can('order_update'), 403);

        $data = $request->validated();
        $order->update($data);

        return redirect()->route('orders.index')->with('success', 'Successfully Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        abort_if(!auth()->user()->can('order_delete'), 403);

        try {
            $order->cart_items()->delete();
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {

            return redirect()->route('orders.index')->with('error', 'Something went wrong!!');

        }
    }

    function print(Order $order) {
        $pdf = PDF::loadView('ecommerce::order.invoice', compact('order'));

        $pdf->output();

        return $pdf->download('ORD' . $order->id . ' ' . $order->user->name . '-invoice.pdf');

    }
}
