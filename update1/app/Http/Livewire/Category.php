<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category as Cat;
use Bsdev\Ecommerce\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $products;
    public $categories;
    public $category;
    public $brands;
    public $selectedBrands = [];
    public $selectedCategories = [];
    public $paginate = 10;
    public $priceMin = 0;
    public $priceMax = 0;
    public $sortBy;
    public function render()
    {
        return view('livewire.category', [
            'productss' => $this->applyFilter(),
        ]);
    }
    public function mount()
    {
        $category_ids = [$this->category->id, $this->category->category_id];
        $childs = $this->category->categories()->where('status', 1)->pluck('id')->toArray();
        $category_ids = array_merge($category_ids, $childs);
        $this->categories = Cat::whereIn('id', $category_ids)->where('status', 1)->with(['products' => function ($query) {
            $query->where('status', 1);
        }])->get();
        $this->products = $this->category->products()->where('status', 1)->with('categories')->get();
        $brand_ids = $this->products->pluck('brand_id')->toArray();
        $this->brands = Brand::whereIn('id', $brand_ids)->where('status', 1)->get();
    }

    public function updated($propertyName)
    {
        $this->applyFilter();
    }

    public function applyFilter()
    {
        $products = Product::query();
        if (count($this->selectedCategories) > 0) {
            $selectedCategories = $this->selectedCategories;
            $products->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('categories.id', $selectedCategories);
            });
        } else {
            $category = $this->category->id;
            $products->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category);
            });
        }
        if (count($this->selectedBrands) > 0) {
            $products->whereIn('brand_id', $this->selectedBrands);
        }
        if ($this->sortBy == "latest") {
            $products->orderBy('created_at', 'DESC');
        }
        if ($this->sortBy == "oldest") {
            $products->orderBy('created_at', 'ASC');
        }
        if ($this->sortBy == "low") {
            $products->orderBy('price', 'ASC');
        }
        if ($this->sortBy == "high") {
            $products->orderBy('price', 'DESC');
        }
        if ($this->priceMin > 0 && $this->priceMax > 0) {
            $products->where('price', '>=', $this->priceMin)->where('price', '<=', $this->priceMax);
        }
        return $products->where('status', 1)->paginate($this->paginate);
    }
    public function setPrice($priceMin, $priceMax)
    {
        // dd($priceMin, $priceMax);
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
    }
}
