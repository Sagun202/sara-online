<?php

namespace Bsdev\Post\Traits;

use Bsdev\Post\Models\Category;
use Bsdev\Post\Models\Post;
use Bsdev\Post\Models\Type;

trait Component
{

    public function countTotalPost()
    {
        return count(Post::all());
    }
    public function countTotalType()
    {
        return count(Type::all());
    }
    public function countTotalCategory()
    {
        return count(Category::all());
    }
    public function countComment()
    {
        return count(Category::all());
    }

}
