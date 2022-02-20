<?php

namespace App;

use App\Models\Cart;
use App\Models\CartItem;
use Bsdev\Ecommerce\Models\Advertisement;
use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Product;
use Bsdev\Vacancy\Models\Vacancy;
use Bsdev\Theme\Models\Testimonial;
use Bsdev\Post\Models\post;
use Bsdev\team\Models\Team;
use Cookie;
use Slider;

class FrontEndHandler
{

    public function banner()
    {
        $sliders = Slider::getSliders();
        return view('frontend.home.slider', compact('sliders'));
    }

    public function getCategoryTree($limit = "all")
    {
        if($limit!="all"){
            return Category::where('category_id', null)->with('allChildrens')->limit($limit)->get();
        }
        return Category::where('category_id', null)->with('allChildrens')->get();
    }
    public function getHomePageCategories()
    {
        $categories = Category::where('show_in_home', 1)->where('status', 1)->orderBy('position', 'ASC')->get();
        return view('frontend.home.categories', compact('categories'));
    }

    public function getProductCard($product)
    {
        return view('frontend.componenets.product', compact('product'));
    }
     public function hotProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('hot', 1)->get();
        return view('frontend.home.hot-deals', compact('products'));
    }
    public function moreProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('more', 1)->get();
        return view('frontend.home.more', compact('products'));
    }
    public function superProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('super', 1)->get();
        return view('frontend.home.super', compact('products'));
    }
    public function topProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('top', 1)->get();
        return view('frontend.home.top-product', compact('products'));
    }
    
      public function recentProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('featured', 1)->get();
        return view('frontend.home.recently-added', compact('products'));
    }
          public function mostPopular()
    {
        $products = Product::where('status', 1)->with('categories')->where('most', 1)->get();
        return view('frontend.home.most-popular', compact('products'));
    }
    public function featuredProducts()
    {
        $products = Product::where('status', 1)->with('categories')->where('featured', 1)->get();
        return view('frontend.home.featured', compact('products'));
    }
    public function getAds($position)
    {
        $ads = Advertisement::where('position', $position)->where('status', 1)->where('expire_at', '>=', now())->first();
        if ($position == 1 && $ads) {
            return view('frontend.home.ads', compact('ads'));
        } elseif ($position == 2 && $ads) {
            return view('frontend.home.ads2', compact('ads'));
        } 
     elseif ($position == 3 && $ads) {
            return view('frontend.home.ads3', compact('ads'));
        } 
         elseif ($position == 4 && $ads) {
            return view('frontend.home.ads4', compact('ads'));
        } 
         elseif ($position == 5 && $ads) {
            return view('frontend.home.ads5', compact('ads'));
        } 
         elseif ($position == 6 && $ads) {
            return view('frontend.home.ads6', compact('ads'));
        } 
         elseif ($position == 7 && $ads) {
            return view('frontend.home.ads7', compact('ads'));
        } 
         elseif ($position == 8 && $ads) {
            return view('frontend.home.ads8', compact('ads'));
        } 
         elseif ($position == 9 && $ads) {
            return view('frontend.home.ads9', compact('ads'));
        } 
         elseif ($position == 10 && $ads) {
            return view('frontend.home.ads10', compact('ads'));
        } 
        else {
            return '';
        }
    }

    public function highlights()
    {
        $brands = Brand::where('status', 1)->orderBy('updated_at', 'DESC')->limit(12)->get();
        return view('frontend.home.highlight', compact('brands'));
    }

    public function getCart()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => auth()->id(),
                    'session' => null,
                ]);
            }

        } else {
            $sessionID = Cookie::get('clickmart');
            if (!isset($sessionID)) {
                $sessionID = session()->getId();
                Cookie::queue('clickmart', $sessionID, '2628000');
            }
            $cart = Cart::where('session', $sessionID)->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => null,
                    'session' => $sessionID,
                ]);
            }

        }
        return $cart;

    }

    public function transferProduct()
    {
        $cart = Cart::where('session', $this->getCookie())->first();
        if ($cart) {
            if (count($cart->cart_items) > 0) {
                $usercart = Cart::where('user_id', auth()->id())->first();
                if ($usercart) {
                    foreach ($cart->cart_items as $item) {
                        foreach ($usercart->cart_items as $user_item) {
                            if ($user_item->product_id == $item->product_id) {
                                $user_item->delete();
                            }
                        }
                    }
                    CartItem::where('cart_id', $cart->id)->update([

                        'cart_id' => $usercart->id,

                    ]);
                }
            }
        }
    }
    public function getCookie()
    {
        $sessionID = Cookie::get('clickmart');
        if (!isset($sessionID)) {
            $sessionID = session()->getId();
            Cookie::queue('clickmart', $sessionID, '2628000');
        }
        return $sessionID;
    }
        public function getVacancies()
    {
        return Vacancy::where('expire_at', '>=', now())->orderBy('updated_at', 'DESC')->get();
    }

    public function showHomeCategory()
    {
        $category = Category::where('status', 1)->where('show_product_in_home', 1)->with('products', function ($query) {
            $query->where('status', 1);
        })->inRandomOrder()->first();
        if (!$category) {
            return '';
        }
        return view('frontend.home.category', compact('category'));
    }
    public function Testimonial()
    {
        $testimonials = Testimonial::all(); {
            return view('frontend.home.testimonial', compact('testimonials'));
        }
      

    }

    public function Blog()
    {
        $blogs = Post::all(); {
            return view('frontend.home.blog', compact('blogs'));
        }
      

    }

}
