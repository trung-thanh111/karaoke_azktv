@php
    $languageId = $config['language'] ?? 1;
    $intro = $widgets['about-intro'] ?? null;
    $featuresWidget = $widgets['about-intro-features'] ?? null;
    $statsWidget = $widgets['about-stats'] ?? null;
    $introBody = $intro ? ($intro->description[$languageId] ?? ($intro->description['1'] ?? '')) : '';
    $introImages = isset($intro->album) && is_array($intro->album) ? $intro->album : [];
    $features = collect($featuresWidget->object ?? []);
    $stats = collect($statsWidget->object ?? []);

    $languageOf = static function ($object) {
        $languages = $object->languages ?? null;
        return $languages instanceof \Illuminate\Support\Collection ? $languages->first() : $languages;
    };
    $objectName = static fn($object) => $object->short_name ?: ($languageOf($object)->name ?? $object->name ?? '');
    $objectDescription = static fn($object) => strip_tags($languageOf($object)->description ?? $object->description ?? '');
@endphp

@if($intro)
<section class="about-intro">
    <div class="karaoke-shell">
        <header class="about-intro__header">
            <h2>{{ $intro->name }}</h2>
            @if(!empty($intro->short_code))
                <div class="about-intro__subtitle">{{ $intro->short_code }}</div>
            @endif
            @if(!empty($introBody))
                <div class="about-intro__text">{!! $introBody !!}</div>
            @endif
        </header>

        @if($features->isNotEmpty())
            <div class="about-intro__features">
                @foreach($features as $feature)
                    <div class="about-intro__feature">
                        <span>
                            @if(!empty($feature->icon))
                                <i class="{{ $feature->icon }}"></i>
                            @elseif(!empty($feature->image))
                                <img src="{{ asset($feature->image) }}" alt="{{ $objectName($feature) }}" loading="lazy">
                            @endif
                        </span>
                        <strong>{{ $objectName($feature) }}</strong>
                    </div>
                @endforeach
            </div>
        @endif

        @if(count($introImages) >= 2)
            <div class="about-intro__images">
                <div class="about-intro__image about-intro__image--left">
                    <img src="{{ asset($introImages[0]) }}" alt="{{ $intro->name }}" loading="lazy">
                </div>
                <div class="about-intro__image about-intro__image--right">
                    <img src="{{ asset($introImages[1]) }}" alt="{{ $intro->name }}" loading="lazy">
                </div>
            </div>
        @endif

        @if(!empty($introBody))
            <div class="about-intro__footer-text">{!! $introBody !!}</div>
        @endif

        @if($stats->isNotEmpty())
            <div class="about-intro__stats">
                @foreach($stats as $stat)
                    <div class="about-intro__stat">
                        <strong>{{ $objectName($stat) }}</strong>
                        <span>{{ $objectDescription($stat) }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif
