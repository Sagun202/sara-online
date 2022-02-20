@if(auth()->user()->can('category_menu'))
<li class="nav-item category-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-chart-pie"></i>

        <p>
            Categories
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('product.categories.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='product.categories.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('product.categories.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='product.categories.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Category</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if(auth()->user()->can('custom_field_menu'))
<li class="nav-item custom-field-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-pager"></i>

        <p>
            Custom Field
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('custom-fields.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='custom-fields.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Field</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('custom-fields.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='custom-fields.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Fields</p>
            </a>
        </li>
    </ul>
</li>
@endif

@if(auth()->user()->can('attribute_menu'))
<li class="nav-item attribute-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-pager"></i>

        <p>
            Attribute
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('attributes.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='attributes.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Attribute</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('attributes.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='attributes.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Attributes</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if(auth()->user()->can('brand_menu'))
<li class="nav-item brand-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-copyright"></i>
        <p>
            Brands
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('brands.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='brands.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Brand </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('brands.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='brands.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Brand</p>
            </a>
        </li>
    </ul>
</li>
@endif

@if(auth()->user()->can('product_menu'))
<li class="nav-item product-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-cart-plus"></i>
        <p>
            Products
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('product.import') }}"
                class="nav-link {{ \Route::currentRouteName()=='product.import'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Import Product </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='products.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Product </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='products.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('productreviews.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='productreviews.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Review</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if(auth()->user()->can('order_menu'))
<li class="nav-item order-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
            Orders
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('orders.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='orders.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Order</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if(auth()->user()->can('advertisement_menu'))
<li class="nav-item advertisement-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-ad"></i>

        <p>
            Advertisement
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('advertisements.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='advertisements.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Advertisement</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('advertisements.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='advertisements.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Advertisement</p>
            </a>
        </li>
    </ul>
</li>
@endif