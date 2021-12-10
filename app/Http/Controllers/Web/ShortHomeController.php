<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\DealOfTheDay;
use App\Model\FlashDeal;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Review;
use App\Model\Seller;
use Illuminate\Support\Facades\DB;

class ShortHomeController extends Controller
{
    public function shortBy($country)
    {
        // dd($country);

        $home_categories = Category::where('home_status', true)->get();
        $home_categories->map(function ($data) use ($country) {
            // dd($country);
            $data['products'] = Product::active()->where('country', $country)->whereJsonContains('category_ids', ['id' => (string) $data['id']])->inRandomOrder()->take(12)->get();
            // dd($data['products']);
        });
        // dd($home_categories);

        $top_sellers = Seller::approved()->with('shop')->where('country', $country)
            ->withCount(['orders'])->orderBy('orders_count', 'DESC')->take(15)->get();

        $featured_products = Product::with(['reviews'])->active()
        ->where('featured', 1)->where('country', $country)
        ->withCount(['order_details'])->orderBy('order_details_count', 'DESC')
        ->take(12)
        ->get();

        $latest_products = Product::with(['reviews'])->active()->where('country', $country)->orderBy('id', 'desc')->take(8)->get();
        $categories = Category::where('position', 0)->take(12)->get();
        $brands = Brand::take(15)->get();
        //best sell product
        // $prod = OrderDetail::with('product')->get()->pluck(('product.country'))->flatten();

        $bestSellProduct = OrderDetail::with('product.reviews')
        ->whereHas('product', function ($query) {
            $query->active();
        })->whereHas('product', fn ($query) => $query->where('country', $country))
        ->select('product_id', DB::raw('COUNT(product_id) as count'))
        ->groupBy('product_id')
        ->orderBy('count', 'desc')
        ->take(4)
        ->get();

        //Top rated
        $topRated = Review::with('product')
            ->whereHas('product', function ($query) {
                $query->active();
            })->whereHas('product', fn ($query) => $query->where('country', $country))
            ->select('product_id', DB::raw('AVG(rating) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->take(4)
            ->get();

        // dd($prod);
        // dd($bestSellProduct);
        if ($bestSellProduct->count() == 0) {
            $bestSellProduct = $latest_products;
        }

        if ($topRated->count() == 0) {
            $topRated = $bestSellProduct;
        }

        $callback = function ($query) use ($country) {
            $query->where('country', $country);
        };

        $flash = FlashDeal::with(['products.product.reviews'])->where(['status' => 1])
        ->where(['deal_type' => 'flash_deal'])->whereDate('start_date', '
            <=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->first();

        // dd($flash_deals);

        $flash->products->map(function ($p) use ($country) {
            // return $p->product->where('country', $country)->get();
            $p['product'] = $p->where('country', $country)->get();
            // dd($p['product']);
        });

        // dd($flash);

        $deal_of_the_day = DealOfTheDay::join('products', 'products.id', '=', 'deal_of_the_days.product_id')->select('deal_of_the_days.*', 'products.unit_price')->where('deal_of_the_days.status', 1)->first();

        return view('web-views.home', compact('country', 'flash', 'featured_products', 'topRated', 'bestSellProduct', 'latest_products', 'categories', 'brands', 'deal_of_the_day', 'top_sellers', 'home_categories'));
    }
}
