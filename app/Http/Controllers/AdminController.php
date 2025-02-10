<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Role;
use App\Models\Permission;
use Artisan;
use Cache;
use CoreComponentRepository;
use Auth;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        // $role = Role::where('guard_name','Super Admin')->first();
        // // $role->givePermissionTo(Permission::all()); // Permission of guard_name = admin
        // dd(Auth::user()->givePermissionTo(Permission::all()));
        CoreComponentRepository::initializeCache();
        $root_categories = Category::where('level', 0)->get();

        $cached_graph_data = Cache::remember('cached_graph_data', 86400, function () use ($root_categories) {
            $num_of_sale_data = null;
            $qty_data = null;
            foreach ($root_categories as $key => $category) {
                $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                $category_ids[] = $category->id;

                $products = Product::with('stocks')->whereIn('category_id', $category_ids)->get();
                $qty = 0;
                $sale = 0;
                foreach ($products as $key => $product) {
                    $sale += $product->num_of_sale;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                }
                $qty_data .= $qty . ',';
                $num_of_sale_data .= $sale . ',';
            }
            $item['num_of_sale_data'] = $num_of_sale_data;
            $item['qty_data'] = $qty_data;

            return $item;
        });

        return view('backend.dashboard', compact('root_categories', 'cached_graph_data'));
    }

    public function inhouseTopCategories(Request $request) {

        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        // Filter based on the time frames
        if ($request->interval_type === 'DAY') {
            $startDate = $today;
        } elseif ($request->interval_type === 'WEEK') {
            $startDate = $weekStart;
        } elseif ($request->interval_type === 'MONTH') {
            $startDate = $monthStart;
        } else {
            $startDate = null; // For 'all' filter
        }

        $categories = Category::select('categories.name AS category_name', 'categories.icon AS category_icon', DB::raw('SUM(order_details.price * order_details.quantity) AS total_price'))
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->join('order_details', 'products.id', '=', 'order_details.product_id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('orders.seller_id', auth()->user()->id);
        if ($startDate) {
            $categories->whereDate('order_details.created_at', '>=', $startDate);
        }
        $categories = $categories->groupBy('categories.id', 'categories.name', 'categories.icon')
        ->get();
        return  view('backend.partials.inhouse_top_categories', compact('categories'))->render();
    }


    public function inhouseTopBrands(Request $request) {

        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        // Filter based on the time frames
        if ($request->interval_type === 'DAY') {
            $startDate = $today;
        } elseif ($request->interval_type === 'WEEK') {
            $startDate = $weekStart;
        } elseif ($request->interval_type === 'MONTH') {
            $startDate = $monthStart;
        } else {
            $startDate = null; // For 'all' filter
        }

        $brands = Brand::select('brands.name AS brand_name', 'brands.logo AS brand_icon', DB::raw('SUM(order_details.price * order_details.quantity) AS total_price'))
        ->join('products', 'brands.id', '=', 'products.brand_id')
        ->join('order_details', 'products.id', '=', 'order_details.product_id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('orders.seller_id', auth()->user()->id);
        if ($startDate) {
            $brands->whereDate('order_details.created_at', '>=', $startDate);
        }
        $brands = $brands->groupBy('brands.id', 'brands.name', 'brands.logo')
        ->get();
        return  view('backend.partials.inhouse_top_brands', compact('brands'))->render();
    }

    function clearCache(Request $request)
    {
        Artisan::call('optimize:clear');
        flash(translate('Cache cleared successfully'))->success();
        return back();
    }
}
