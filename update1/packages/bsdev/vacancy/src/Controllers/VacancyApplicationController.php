<?php

namespace Bsdev\Vacancy\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Vacancy\DataTables\VacancyApplicationDataTable;
use Bsdev\Vacancy\Models\VacancyApplication;
use Bsdev\Vacancy\Requests\UpdateVacancyApplicationRequest;
use Illuminate\Http\Request;

class VacancyApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VacancyApplicationDataTable $dataTable)
    {
        return $dataTable->render('vacancy::application.index');
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
     * @param  \App\Models\VacancyApplication  $vacancyApplication
     * @return \Illuminate\Http\Response
     */
    public function show(VacancyApplication $vacancyApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VacancyApplication  $vacancyApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(VacancyApplication $vacancyapplication)
    {
        return view('vacancy::application.edit', compact('vacancyapplication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VacancyApplication  $vacancyApplication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVacancyApplicationRequest $request, VacancyApplication $vacancyapplication)
    {
        try {

            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;
            $vacancyapplication->update($data);
            return redirect()->route('vacancyapplications.index')->with('success', 'Successfully Updated');

        } catch (\Exception $ex) {

            return redirect()->route('vacancyapplications.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VacancyApplication  $vacancyApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacancyApplication $vacancyapplication)
    {
        try {

            $vacancyapplication->delete();

            return redirect()->route('vacancyapplications.index')->with('success', 'Successfully Deleted');

        } catch (\Exception $ex) {

            return redirect()->route('vacancyapplications.index')->with('error', 'Something went wrong!!');

        }
    }
}
