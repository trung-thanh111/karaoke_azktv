@php
    $languageId = $config['language'] ?? 1;
    $hero = $widgets['about-hero'] ?? null;
    $heroDesc = $hero ? ($hero->description[$languageId] ?? ($hero->description['1'] ?? '')) : '';
    $heroTitle = $hero->name ?? '';
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
