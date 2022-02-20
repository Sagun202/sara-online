<?php

namespace Bsdev\Team\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Team\DataTables\DesignationDataTable;
use Bsdev\Team\Models\Designation;
use Bsdev\Team\Requests\StoreDesignationRequest;
use Bsdev\Team\Requests\UpdateDesignationRequest;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DesignationDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('team_view'), 403);

        return $dataTable->render('team::designation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('team_create'), 403);

        return view('team::designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignationRequest $request)
    {
        abort_if(!auth()->user()->can('team_create'), 403);

        try {

            $data = $request->validated();

            (!$request->status) ? $data['status'] = 0 : $data['status'] = 1;
            Designation::create($data);

            return redirect()->route('designations.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('designations.index')->with('error', 'Something went wrong!!');

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
    public function edit(Designation $designation)
    {
        abort_if(!auth()->user()->can('team_edit'), 403);

        return view('team::designation.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        abort_if(!auth()->user()->can('team_update'), 403);

        try {

            $data = $request->validated();
            (!$request->status) ? $data['status'] = 0 : $data['status'] = 1;
            $designation->update($data);

            return redirect()->route('designations.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('designations.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        abort_if(!auth()->user()->can('team_delete'), 403);

        try {

            $designation->delete();

            return redirect()->route('designations.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('designations.index')->with('error', 'Something went wrong!!');

        }
    }
}
