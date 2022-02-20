<?php

namespace Bsdev\Ecommerce\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Ecommerce\DataTables\CustomFieldDataTable;
use Bsdev\Ecommerce\Models\CustomField;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomFieldDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('custom_field_view'), 403);

        return $dataTable->render('ecommerce::customfield.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('custom_field_create'), 403);

        return view('ecommerce::customfield.create');
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
    public function edit(CustomField $custom_field)
    {
        abort_if(!auth()->user()->can('custom_field_edit'), 403);

        return view('ecommerce::customfield.edit', compact('custom_field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomField $custom_field)
    {
        abort_if(!auth()->user()->can('custom_field_delete'), 403);

        try {

            $custom_field->categories()->sync([]);
            $custom_field->delete();

            return redirect()->route('custom-fields.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('custom-fields.index')->with('error', 'Something went wrong!!');

        }
    }
}
