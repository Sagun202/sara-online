<?php

namespace Bsdev\Ecommerce\Facades;

use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Order;
use Bsdev\Ecommerce\Models\Product;
use Theme;

class Ecommerce
{
    public function getCategory()
    {
        return Category::all();
    }
    public function getProducts()
    {
        return Product::all();
    }
    public function getCategoryTree()
    {
        return Category::where('category_id', null)->with('categories')->get();
    }

    public function getMenu()
    {

        if (!Theme::checkModuleStatus('Ecommerce')) {
            return '';
        }
        return view('ecommerce::menu');
    }
    public function getBrands()
    {
        return Brand::all();
    }

    public function getPermissions()
    {
        if (!Theme::checkModuleStatus('Ecommerce')) {
            return [];
        }
        return [
            'product_create',
            'product_view',
            'product_edit',
            'product_update',
            'product_delete',
            'product_menu',
            'category_create',
            'category_view',
            'category_edit',
            'category_update',
            'category_delete',
            'category_menu',
            'brand_create',
            'brand_view',
            'brand_edit',
            'brand_update',
            'brand_delete',
            'brand_menu',
            'order_menu',
            'order_create',
            'order_view',
            'order_edit',
            'order_update',
            'order_delete',
            'custom_field_create',
            'custom_field_view',
            'custom_field_edit',
            'custom_field_update',
            'custom_field_delete',
            'custom_field_menu',
            'advertisement_create',
            'advertisement_view',
            'advertisement_edit',
            'advertisement_update',
            'advertisement_delete',
            'advertisement_menu',
            'attribute_create',
            'attribute_view',
            'attribute_edit',
            'attribute_update',
            'attribute_delete',
            'attribute_menu',

        ];

    }

    public function getComponent()
    {

        return view('ecommerce::component');
    }

    public function pendingOrderCount()
    {
        return Order::where('order_status', 1)->get();
    }
    public function confirmOrderCount()
    {
        return Order::where('order_status', 2)->get();
    }
    public function packedOrderCount()
    {
        return Order::where('order_status', 3)->get();
    }
    public function deliveredOrderCount()
    {
        return Order::where('order_status', 4)->get();
    }
    public function cancelledOrderCount()
    {
        return Order::where('order_status', 5)->get();
    }
}
