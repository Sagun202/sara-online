<li class="nav-item team-menu">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Team
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('designations.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='designations.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Designation</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('designations.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='designations.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Designation</p>
            </a>
        </li>

    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('teams.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='teams.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Team</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teams.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='teams.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Team</p>
            </a>
        </li>

    </ul>
</li>