<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 
use View;
use Illuminate\Support\Facades\File;

class SitemapController extends Controller
{
    
    public function index(Request $request)
    {
        $products = Product::orderBy('id','desc')->where('published',1)->get(); 
        $categories = Category::orderBy('id','desc')->get();
        \Artisan::call('view:clear');
        \Artisan::call('optimize:clear');
        //sitemap update
        (new SitemapController())->update();
    
        // return response()->view('sitemap', compact('products', 'categories'))
        //   ->header('Content-Type', 'application/xml');

    }
    
    public function update()
    {
        // Your logic to generate or update the sitemap.xml content
        $sitemapContent = $this->generateSitemapContent();
        // Save the updated sitemap.xml file
        File::put(base_path('sitemap.xml'), $sitemapContent);
        

        return response()->json(['message' => 'Sitemap updated successfully']);
    }

    private function generateSitemapContent()
    {
        // Your logic to generate the sitemap content
        // This could involve querying your database or generating dynamic URLs

        $products = Product::orderBy('id','desc')->where('published',1)->get(); 
        $categories = Category::orderBy('id','desc')->get();
        return View::make('sitemap', compact('products', 'categories'))->render();
    }
}

 