<?php
namespace Bsdev\Theme\Traits;

use App\Models\User;
use Bsdev\Theme\Models\Menu;
use Bsdev\Theme\Models\Subscription;
use Bsdev\Theme\Models\Testimonial;
trait Component
{

    public function countTotalUser()
    {
        return count(User::all());
    }
    public function countTotalSubscriber()
    {
        return count(Subscription::all());
    }
    public function countMenu()
    {
        return count(Menu::all());
    }

    public function countTestimonials()
    {
        return count(Testimonial::all());
    }

}
