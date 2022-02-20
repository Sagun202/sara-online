<?php

namespace Bsdev\Post\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Post\DataTables\TypeDataTable;
use Bsdev\Post\Models\Type;
use Bsdev\Post\Requests\StoreTypeRequest;
use Bsdev\Post\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypeDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('post_view'), 403);

        return $dataTable->render('post::type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('post_create'), 403);

        return view('post::type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        abort_if(!auth()->user()->can('post_create'), 403);

        try {

            $data = $request->validated();
            Type::create($data);

            return redirect()->route('types.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('types.index')->with('error', 'Something went wrong!!');

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
    public function edit(Type $type)
    {
        abort_if(!auth()->user()->can('post_edit'), 403);

        return view('post::type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        abort_if(!auth()->user()->can('post_update'), 403);

        try {

            $data = $request->all();
            $type->update($data);

            return redirect()->route('types.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('types.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        abort_if(!auth()->user()->can('post_delete'), 403);

        try {

            $type->delete();

            return redirect()->route('types.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('types.index')->with('error', 'Something went wrong!!');

        }
    }

    public function getCategories(Request $request)
    {

        $type = Type::find($request->type_id);
        return response()->json(['data' => $type->categories]);

    }
}
