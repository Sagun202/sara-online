<li class="nav-item slider-menu">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-image"></i>
        <p>
            Sliders
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('sliders.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='sliders.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Slider</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sliders.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='sliders.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Sliders</p>
            </a>
        </li>

    </ul>
</li>