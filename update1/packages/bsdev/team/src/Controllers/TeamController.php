<?php

namespace Bsdev\Team\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Team\DataTables\TeamDataTable;
use Bsdev\Team\Models\Team;
use Bsdev\Team\Requests\StoreTeamRequest;
use Bsdev\Team\Requests\UpdateTeamRequest;
use Bsdev\Team\Traits\FileUpload;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeamDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('team_view'), 403);

        return $dataTable->render('team::team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('team_create'), 403);

        return view('team::team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        abort_if(!auth()->user()->can('team_create'), 403);

        try {

            $data = $request->validated();

            if ($request->image) {
                $data['image'] = $this->uploadFile('team', $request->image);
            }
            Team::create($data);

            return redirect()->route('teams.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('teams.index')->with('error', 'Something went wrong!!');

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
    public function edit(Team $team)
    {
        abort_if(!auth()->user()->can('team_edit'), 403);

        return view('team::team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        abort_if(!auth()->user()->can('team_update'), 403);

        try {

            $data = $request->validated();

            if ($request->image) {
                $data['image'] = $this->uploadFile('team', $request->image);
            }
            $team->update($data);

            return redirect()->route('teams.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('teams.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        abort_if(!auth()->user()->can('team_delete'), 403);

        try {

            $team->delete();

            return redirect()->route('teams.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('teams.index')->with('error', 'Something went wrong!!');

        }

    }
}
