<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $products;

    public $title;
    public $categories;
    public $brands;
    public $priceMin = 0;
    public $priceMax = 0;
    public $selectedBrands = [];
    public $selectedCategories = [];
    public $sortBy;
    public $paginate = 100;
    public function mount()
    {
        $categories = array_unique($this->products->pluck('categories')->flatten()->pluck('id')->toArray());
        $this->categories = Category::find($categories);
        $brand_ids = array_unique($this->products->pluck('brand_id')->flatten()->toArray());
        $this->brands = Brand::find($brand_ids);
    }
    public function render()
    {
        return view('livewire.product-list', [
            'productss' => $this->applyFilter(),
        ]);
    }

    public function updated($propertyName)
    {
        $this->applyFilter();
    }

    public function applyFilter()
    {
        $products = Product::query();
        if(count($this->products)>0){
            $products->whereIn('id',$this->products->pluck('id')->toArray());
            if (count($this->selectedCategories) > 0) {
                $selectedCategories = $this->selectedCategories;
                $products->whereHas('categories', function ($query) use ($selectedCategories) {
                    $query->whereIn('categories.id', $selectedCategories);
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
        }else{
            return $products->whereIn('id',$this->products->pluck('id')->toArray())->paginate($this->paginate);
        }
    }
    public function setPrice($priceMin, $priceMax)
    {
        // dd($priceMin, $priceMax);
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
    }
}
