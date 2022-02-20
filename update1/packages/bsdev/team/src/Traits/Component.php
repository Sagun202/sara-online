<?php

namespace Bsdev\Team\Traits;

use Bsdev\Team\Models\Designation;
use Bsdev\Team\Models\Team;
trait Component
{

    public function countDesignations()
    {
        return count(Designation::all());
    }
    public function countTeam()
    {
        return count(Team::all());

    }

}
