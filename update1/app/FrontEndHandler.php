<?php

namespace App;

use App\Models\Cart;
use App\Models\CartItem;
use Bsdev\Ecommerce\Models\Advertisement;
use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Product;
use Bsdev\Vacancy\Models\Vacancy;
use Cookie;
use Slider;

class FrontEndHandler
{

  public function hotProducts()
    {
        $products = Product::where('status', 1)->where('featured', 1)->get();
        return view('frontend.home.hot-deals', compact('products'));
    }
    public function banner()
    {
        $sliders = Slider::getSliders();
        return view('frontend.home.slider', compact('sliders'));
    }

    public function getCategoryTree($limit = "all")
    {
        if ($limit != "all") {
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
    public function topProducts()
    {
        $products = Product::where('status', 1)->where('featured', 1)->get();
        return view('frontend.home.top-product', compact('products'));
    }
    public function featuredProducts()
    {
        $products = Product::where('status', 1)->where('featured', 1)->get();
        return view('frontend.home.featured', compact('products'));
    }
    public function getAds($position)
    {
        $ads = Advertisement::where('position', $position)->where('status', 1)->where('expire_at', '>=', now())->first();
        if ($position == 1 && $ads) {
            return view('frontend.home.ads', compact('ads'));
        } elseif ($position == 2 && $ads) {
            return view('frontend.home.ads2', compact('ads'));
        } else {
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
}
