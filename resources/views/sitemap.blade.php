<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
            xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
        
        <url>
            <loc>{{ url('/') }}</loc>
            <lastmod>2024-03-12T10:37:51+00:00</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        
        <url>
            <loc>{{ url('/brands') }}</loc>
            <lastmod>2024-03-12T10:37:51+00:00</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        <url>
            <loc>{{ url('/categories') }}</loc>
            <lastmod>2024-03-12T10:37:51+00:00</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        <url>
            <loc>{{ url('/search') }}</loc>
            <lastmod>2024-03-12T10:37:51+00:00</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        
        @foreach($categories as $category)
        <url>
            <loc>{{ url('/category/'.$category->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($category->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        @endforeach
        
        @foreach($products as $product)
        <url>
            <loc>{{ url('/product/'.$product->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($product->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        @endforeach
        
        @php
            $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
        @endphp
        @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
        <url>
            <loc>{{ route('flash-deal-details', $flash_deal->slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($flash_deal->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        @endif
        
    </urlset>
 
   