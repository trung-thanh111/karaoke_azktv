@php
    $languageId = $config['language'] ?? 1;
    $hero = $widgets['about-hero'] ?? null;
    $heroDesc = $hero ? ($hero->description[$languageId] ?? ($hero->description['1'] ?? '')) : '';
    if (is_string($heroDesc)) {
        $cleanedDesc = html_entity_decode(strip_tags($heroDesc));
        $decoded = json_decode($cleanedDesc, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $heroDesc = $decoded;
        } else {
            $heroDesc = $cleanedDesc;
        }
    }
    $heroTitle = is_array($heroDesc) ? ($heroDesc['title'] ?? ($hero->name ?? 'GIỚI THIỆU')) : (!empty($heroDesc) ? $heroDesc : ($hero->name ?? 'GIỚI THIỆU'));
    $heroBg = isset($hero->album) && is_array($hero->album) ? ($hero->album[0] ?? '') : '';
@endphp
@if($hero)
<section class="about-hero">
    @if($heroBg)
        <img class="about-hero__bg" src="{{ asset($heroBg) }}" alt="{{ $heroTitle }}" loading="lazy">
    @endif
    <div class="hero-overlay"></div>
    <div class="uk-container uk-container-center hero-content">
        <h1 class="hero-title">
            <span class="decor-line left"></span>
            {{ $heroTitle }}
            <span class="decor-line right"></span>
        </h1>
    </div>
</section>
@endif
