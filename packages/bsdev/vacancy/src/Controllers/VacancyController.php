<?php

namespace Bsdev\Vacancy\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Vacancy\DataTables\VacancyDataTable;
use Bsdev\Vacancy\Models\Vacancy;
use Bsdev\Vacancy\Requests\StoreVacancyRequest;
use Bsdev\Vacancy\Requests\UpdateVacancyRequest;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VacancyDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('vacancy_view'), 403);

        return $dataTable->render('vacancy::vacancy.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('vacancy_create'), 403);

        return view('vacancy::vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacancyRequest $request)
    {
        abort_if(!auth()->user()->can('vacancy_create'), 403);

        try {
            $data = $request->validated();
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $data['seo'] = $seo;

            Vacancy::create($data);

            return redirect()->route('vacancies.index')->with('success', 'Successfully Created');

        } catch (\Exception $ex) {

            return redirect()->route('vacancies.index')->with('error', 'Something went wrong');

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
    public function edit(Vacancy $vacancy)
    {
        abort_if(!auth()->user()->can('vacancy_edit'), 403);

        return view('vacancy::vacancy.edit', compact('vacancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        abort_if(!auth()->user()->can('vacancy_update'), 403);

        try {
            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }
            $data['seo'] = $seo;
            $vacancy->update($data);

            return redirect()->route('vacancies.index')->with('success', 'Successfully Updated');
        } catch (\Exception $ex) {

            return redirect()->route('vacancies.index')->with('error', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        abort_if(!auth()->user()->can('vacancy_delete'), 403);

        try {

            $vacancy->delete();

            return redirect()->route('vacancies.index')->with('success', 'Successfully Deleted');

        } catch (\Exception $ex) {

            return redirect()->route('vacancies.index')->with('error', 'Something went wrong');

        }
    }
}
