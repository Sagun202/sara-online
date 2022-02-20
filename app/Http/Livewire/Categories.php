<?php

namespace App\Http\Livewire;

use Bsdev\Ecommerce\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $categories = Category::where('status', 1)->paginate(500);
        return view('livewire.categories', [
            'categories' => $categories,
        ]);
    }
}
