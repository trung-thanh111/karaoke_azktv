@php
    $languageId = $config['language'] ?? 1;
    $bannerSlide = \App\Models\Slide::where('keyword', 'home-banner')->first();
    $bannerItems = $bannerSlide ? ($bannerSlide->item[$languageId] ?? ($bannerSlide->item['1'] ?? [])) : [];
    $banner = $bannerItems[0] ?? null;
@endphp

@if($banner && !empty($banner['image']))
<section class="home-banner-section about-banner-section">
    <div class="banner-item">
        <a href="{{ $banner['url'] ?? '#' }}" target="{{ $banner['target'] ?? '_self' }}">
            <img src="{{ asset($banner['image']) }}" alt="{{ $banner['title'] ?? 'Banner' }}" loading="lazy">
        </a>
    </div>
</section>
@endif
