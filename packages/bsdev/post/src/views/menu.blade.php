<li class="nav-item post-menu">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-rss-square"></i>
        <p>
            Post
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('types.create') }}" class="nav-link {{ \Route::currentRouteName()=='types.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Type</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('types.index') }}" class="nav-link {{ \Route::currentRouteName()=='types.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Types</p>
            </a>
        </li>

    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('categories.create') }}" class="nav-link {{ \Route::currentRouteName()=='categories.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{ \Route::currentRouteName()=='categories.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Categories</p>
            </a>
        </li>

    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('posts.create') }}" class="nav-link {{ \Route::currentRouteName()=='posts.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Post</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('posts.index') }}" class="nav-link {{ \Route::currentRouteName()=='posts.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Posts</p>
            </a>
        </li>

    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('postcomment.index') }}" class="nav-link {{ \Route::currentRouteName()=='postcomment.index'?'active':'' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>List Comments</p>
            </a>
        </li>

    </ul>
</li>