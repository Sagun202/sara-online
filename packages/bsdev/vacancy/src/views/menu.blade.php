@if(auth()->user()->can('vacancy_menu'))
<li class="nav-item vacancy-menu">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Vacacny
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('vacancies.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='vacancies.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Vacancy</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vacancies.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='vacancies.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Vacancy</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vacancyapplications.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='vacancyapplications.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Application</p>
            </a>
        </li>

    </ul>

</li>
@endif