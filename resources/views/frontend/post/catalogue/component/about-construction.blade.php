@php
    $languageId = $config['language'] ?? 1;
    $constructionWidget = $widgets['karaoke-construction'] ?? null;
    $constructionData = $constructionWidget ? ($constructionWidget->description[$languageId] ?? ($constructionWidget->description['1'] ?? [])) : [];
    $constructionCards = collect($constructionWidget->object ?? []);
    
    $languageOf = static function ($object) {
        $languages = $object->languages ?? null;
        return $languages instanceof \Illuminate\Support\Collection ? $languages->first() : $languages;
    };
    $objectName = static fn($object) => $languageOf($object)->pivot->name ?? ($languageOf($object)->name ?? ($object->name ?? ''));
    $objectUrl = static fn($object) => !empty($languageOf($object)->pivot->canonical ?? ($languageOf($object)->canonical ?? null))
        ? rewrite_url($languageOf($object)->pivot->canonical ?? $languageOf($object)->canonical)
        : '#';
    $imageUrl = static fn($image, $index = null) => !empty($image) ? asset($image) : 'https://placehold.co/600x400?text=' . ($index ?? 'Image');
@endphp

@if ($constructionWidget)
    <section class="karaoke-card-section karaoke-card-section--construction">
        @if (!empty($constructionData['background']))
            <img class="karaoke-section-bg" src="{{ asset($constructionData['background']) }}"
                alt="{{ $constructionData['title'] ?? ($constructionWidget->name ?? '') }}" loading="lazy">
        @endif
        <div class="karaoke-card-section__overlay"></div>
        <div class="karaoke-shell">
            @if (!empty($constructionData['title']))
                <header class="karaoke-section-heading">
                    <span></span>
                    <h2>{{ $constructionData['title'] }}</h2>
                    <span></span>
                </header>
            @endif
            @if ($constructionCards->isNotEmpty())
                <div class="karaoke-room-grid">
                    @foreach ($constructionCards as $card)
                        @php
                            $cardTitle = $objectName($card);
                            $cardImage = $card->image ?? '';
                            $cardUrl = $objectUrl($card);
                        @endphp
                        <a class="karaoke-room-card" href="{{ $cardUrl }}" title="{{ $cardTitle }}">
                            @if ($cardImage)
                                <img src="{{ $imageUrl($cardImage, $loop->index) }}" alt="{{ $cardTitle }}"
                                    loading="lazy">
                            @endif
                            <span>{{ $cardTitle }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
