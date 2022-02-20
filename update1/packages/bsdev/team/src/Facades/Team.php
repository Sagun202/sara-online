<?php

namespace Bsdev\Team\Facades;

use Bsdev\Team\Models\Designation;
use Bsdev\Team\Models\Team as Te;
use Bsdev\Team\Traits\Component;
use Theme;

class Team
{

    use Component;

    public function getParentDesignation()
    {
        return Designation::where('designation_id', null)->get();

    }
    public function getMenu()
    {
        if (!auth()->user()->can('team_menu')) {

            return '';
        }

        if (!Theme::checkModuleStatus('Team')) {
            return '';
        }
        $view = view('team::menu')->render();
        return $view;
    }
    public function getDesignations()
    {
        return Designation::where('status', 1)->with('teams')->orderBy('position', 'ASC')->get();
    }

    public function getPermissions()
    {
        if (!Theme::checkModuleStatus('Team')) {
            return false;
        }

        return [

            'team_menu',
            'team_create',
            'team_edit',
            'team_delete',
            'team_view',
            'team_update',
        ];
    }
    public function getComponent()
    {
        if (!Theme::checkModuleStatus('Team')) {
            return '';
        }
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {

            return view('team::component');
        }
    }

    public function getParentDesignations()
    {
        if (!Theme::checkModuleStatus('Team')) {
            return [];
        }
        return Designation::with(['teams' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->orderBy('position', 'ASC')->where('designation_id', null)->get();

    }

    public function getChildDesignation($designation)
    {

        $designation = Designation::where('id', $designation)->first();
        if (!Theme::checkModuleStatus('Team')) {
            return [];
        }
        return $designation->designations()->where('status', 1)->orderBy('position', 'ASC')->get();

    }

    public function getMemberByDesignation($designation, $limit = 0)
    {
        $designation = Designation::where('id', $designation)->first();

        if (!Theme::checkModuleStatus('Team')) {
            return [];
        }
        if ($limit > 0) {

            return $designation->teams()->where('status', 1)->orderBy('position', 'ASC')->limit($limit)->get();
        } else {

            return $designation->teams()->where('status', 1)->orderBy('position', 'ASC')->get();

        }
    }
    public function getTeamDetail($team)
    {
        $team = Te::where('id', $team)->where('status', 1)->first();
        if (!Theme::checkModuleStatus('Team')) {
            return null;
        }
        return $team;
    }

    public function getTeams($limit = 0)
    {
        if (!Theme::checkModuleStatus('Team')) {
            return [];

        }

        if ($limit > 0) {

            return Te::with('designation')->orderBy('position', 'ASC')->limit($limit)->get();
        } else {

            return Te::with('designation')->orderBy('position', 'ASC')->get();

        }
    }

}
