<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Bsdev\Ecommerce\Models\Brand;
use Bsdev\Ecommerce\Models\Category;
use Bsdev\Ecommerce\Models\Product;
use Bsdev\Vacancy\Models\Vacancy;
use Illuminate\Http\Request;
use Seo;
use Theme;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = Theme::siteSetup();
        Seo::setSeo($site->name, $site->introduction, '', asset('storage/' . $site->logo));
        return view('frontend.index');
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->with('variations', 'reviews')->first();
        if (!$product) {
            abort(404);
        }
        $related = Category::whereIn('id', $product->categories->pluck('id')->toArray())->with(['products' => function ($query) use ($product) {
            $query->where('products.id', '!=', $product->id)->where('status', 1);
        }])->get()->pluck('products')->flatten();

        Seo::setSeo($product->seo['meta_title'] ?? $product->title, $product->seo['meta_description'] ?? $product->short_description, '', asset('storage/' . $product->thumbnail));
        return view('frontend.product-detail', compact('product', 'related'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->with(['categories', 'products' => function ($query) {
            $query->where('status', 1);
        }])->first();
        if (!$category) {
            abort(404);
        }
        Seo::setSeo($category->seo['meta_title'] ?? $category->name, $category->seo['meta_description'] ?? $category->short_description, '', asset('storage/' . $category->thumbnail));
        return view('frontend.category', compact('category'));
    }
    public function brand($slug)
    {
        $brand = Brand::where('slug', $slug)->where('status', 1)->first();
        if (!$brand) {
            abort(404);
        }
        Seo::setSeo($brand->seo['meta_title'] ?? $brand->name, $brand->seo['meta_description'] ?? '', '', asset('storage/' . $brand->image));
        return view('frontend.brand-detail', compact('brand'));
    }

    public function productList($slug)
    {
        if ($slug == 'top-products') {
            $title = "Top Products";
            $products = Product::with('categories', 'brand')->where('featured', 1)->get();
        } else if ($slug == 'featured-products') {
            $title = "Featured Products";

            $products = Product::with('categories', 'brand')->where('featured', 1)->get();
        } else {
            abort(404);
        }
        Seo::setSeo($title);
        return view('frontend.product-list', compact('products', 'title'));
    }

    public function cart()
    {
        Seo::setSeo('Cart');
        return view('frontend.cart');
    }

    public function help()
    {
        $content = Theme::getCMSBySlug('help-center');
        if (!$content) {
            abort(404);
        }

        Seo::setSeo($content->seo['meta_title'] ?? 'Help Center', $content->seo['meta_description'] ?? '', '', asset('storage/' . $content->image));

        return view('frontend.help-center', compact('content'));
    }

    public function checkout()
    {
        Seo::setSeo('Checkout');

        return view('frontend.checkout');
    }

    public function userDashboard()
    {

        Seo::setSeo('User Dashboard');
        return view('frontend.user.index');
    }

    public function privacy()
    {
        $content = Theme::getCMSBySlug('privacy');
        if (!$content) {
            abort(404);
        }
        Seo::setSeo($content->seo['meta_title'] ?? '', $content->seo['meta_description'] ?? '', '', asset('storage/' . $content->image));
        return view('frontend.privacy', compact('content'));
    }
    public function termsOfSale()
    {
        $content = Theme::getCMSBySlug('terms-of-sale');
        if (!$content) {
            abort(404);
        }
        Seo::setSeo($content->seo['meta_title'] ?? '', $content->seo['meta_description'] ?? '', '', asset('storage/' . $content->image));
        return view('frontend.term-sale', compact('content'));
    }
    public function termsOfUse()
    {
        $content = Theme::getCMSBySlug('terms-of-use');
        if (!$content) {
            abort(404);
        }
        Seo::setSeo($content->seo['meta_title'] ?? '', $content->seo['meta_description'] ?? '', '', asset('storage/' . $content->image));
        return view('frontend.term-use', compact('content'));
    }
    public function warranty()
    {
        $content = Theme::getCMSBySlug('warranty');
        if (!$content) {
            abort(404);
        }
        Seo::setSeo($content->seo['meta_title'] ?? '', $content->seo['meta_description'] ?? '', '', asset('storage/' . $content->image));
        return view('frontend.warranty', compact('content'));
    }

    public function about()
    {
        Seo::setSeo('About');
        return view('frontend.about');
    }
    public function jobDetail($slug)
    {
        $job = Vacancy::where('slug', $slug)->where('expire_at', '>=', now())->first();
        if (!$job) {
            abort(404);
        }
        Seo::setSeo($job->seo['meta_title'] ?? $job->title, $job->seo['meta_description'] ?? $job->short_description);

        return view('frontend.job-detail', compact('job'));
    }
    public function sell()
    {
        Seo::setSeo('Sell with Us');
        return view('frontend.sell');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function wishLists()
    {
        Seo::setSeo('Wish Lists');
        $lists = WishList::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->with('product')->get();
        return view('frontend.user.wish-list', compact('lists'));
    }
    public function removeWishList($wishlist)
    {
        $wishlist = WishList::where('user_id', auth()->id())->where('id', $wishlist)->first();
        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Successfully Removed!!');
        }
        return redirect()->back()->with('error', 'Bad Request!!');

    }

}
