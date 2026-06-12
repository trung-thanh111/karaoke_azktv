@php
    $languageId = $config['language'] ?? 1;
    $hero = $slides[\App\Enums\SlideEnum::MAIN] ?? ($slides['index-slide'] ?? []);
    $heroItems = $hero['item'] ?? [];
    $heroSettings = $hero['setting'] ?? [];
    $heroStats = !empty($heroSettings['stats']) ? $heroSettings['stats'] : [
        ['value' => '10+', 'label' => 'Năm kinh nghiệm'],
        ['value' => '34+', 'label' => 'Tỉnh thành'],
        ['value' => '10+', 'label' => 'Quốc gia'],
        ['value' => '500+', 'label' => 'Dự án hoàn thành'],
    ];
    $heroActions = !empty($heroSettings['actions']) ? $heroSettings['actions'] : [
        ['label' => 'Nhận báo giá miễn phí', 'url' => '#'],
        ['label' => 'Xem các mẫu phòng', 'url' => '#'],
    ];
    $introWidget = $widgets['intro'] ?? null;
    $introDescription = $introWidget->description[$languageId] ?? ($introWidget->description['1'] ?? []);
    $introImages = $introWidget->album ?? [];
    $introFeatures = $introDescription['features'] ?? [];
    $introServices = $introDescription['services'] ?? [];
    $introAction = $introDescription['action'] ?? [];
    $constructionWidget = $widgets['karaoke-construction'] ?? null;
    $constructionData = $constructionWidget->description[$languageId] ?? ($constructionWidget->description['1'] ?? []);
    $constructionCards = collect($constructionWidget->object ?? []);
    $productWidget = $widgets['featured-products'] ?? null;
    $productData = $productWidget->description[$languageId] ?? ($productWidget->description['1'] ?? []);
    $productCards = collect($productWidget->object ?? []);
    $designsWidget = $widgets['home-designs'] ?? null;
    $designsData = $designsWidget
        ? $designsWidget->description[$languageId] ?? ($designsWidget->description['1'] ?? [])
        : [];
    $designObjects = collect($designsWidget->object ?? []);
    $newsWidget = $widgets['home-news'] ?? null;
    $newsData = $newsWidget ? $newsWidget->description[$languageId] ?? ($newsWidget->description['1'] ?? []) : [];
    $newsObjects = collect($newsWidget->object ?? [])->keyBy('id');
    $languageOf = static function ($object) {
        $languages = $object->languages ?? null;
        return $languages instanceof \Illuminate\Support\Collection ? $languages->first() : $languages;
    };
    $objectName = static fn($object) => $languageOf($object)->name ?? ($object->name ?? '');
    $objectDescription = static fn($object) => $languageOf($object)->description ?? ($object->description ?? '');
    $objectUrl = static fn($object) => !empty($languageOf($object)->canonical ?? null)
        ? rewrite_url($languageOf($object)->canonical)
        : '#';
    $imageFallbacks = [
        '/uploads/images/thiet-ke/thiet-ke-phong-khach-01.jpg',
        '/uploads/images/thiet-ke/thiet-ke-phong-hop-01.jpg',
        '/uploads/images/thiet-ke/thiet-ke-phong-giam-doc-01.jpg',
        '/uploads/images/thiet-ke/thiet-ke-nha-hang-01.jpg',
    ];
    $imageUrl = static function ($path, $index = 0) use ($imageFallbacks) {
        $path = $path ?: '';
        if ($path && file_exists(public_path(ltrim($path, '/')))) {
            return asset($path);
        }
        return asset($imageFallbacks[$index % count($imageFallbacks)]);
    };
@endphp

<main class="karaoke-home">
    @if (!empty($heroItems))
        <section class="karaoke-hero">
            <div class="karaoke-hero__slider uk-slidenav-position"
                data-uk-slideshow="{animation:'fade', autoplay:true, autoplayInterval:5500}">
                <ul class="uk-slideshow">
                    @foreach ($heroItems as $item)
                        @php
                            $heroImage = $item['image'] ?? '';
                            $heroUrl = $item['canonical'] ?? '#';
                            $heroTarget = !empty($item['window']) ? '_blank' : '_self';
                        @endphp
                        <li>
                            <div class="karaoke-hero__bg">
                                @if ($heroImage)
                                    <img class="karaoke-section-bg" src="{{ $heroImage }}"
                                        alt="{{ $item['alt'] ?? ($item['name'] ?? '') }}">
                                @endif
                                <div class="karaoke-hero__overlay"></div>
                                <div class="karaoke-shell">
                                    <div class="karaoke-hero__content">
                                        @if (!empty($item['name']))
                                            <div class="karaoke-hero__eyebrow">{{ $item['name'] }}</div>
                                        @endif
                                        @if (!empty($item['alt']))
                                            <h2 class="karaoke-hero__title">{{ $item['alt'] }}</h2>
                                        @endif
                                        @if (!empty($item['description']))
                                            <div class="karaoke-hero__desc">{!! nl2br(e($item['description'])) !!}</div>
                                        @endif
                                        @if (!empty($heroActions))
                                            <div class="karaoke-hero__actions">
                                                @foreach ($heroActions as $action)
                                                    @php
                                                        $actionLabel = $action['label'] ?? '';
                                                        $actionUrl = $action['url'] ?? $heroUrl;
                                                    @endphp
                                                    @if ($actionLabel)
                                                        <a class="karaoke-btn" href="{{ $actionUrl }}"
                                                            target="{{ $heroTarget }}">
                                                            <span>{{ $actionLabel }}</span>
                                                            <i class="fa fa-long-arrow-right"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @if (count($heroItems) > 1)
                    <ul class="uk-dotnav karaoke-hero__dots">
                        @foreach ($heroItems as $key => $item)
                            <li data-uk-slideshow-item="{{ $key }}"><a href="#"></a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            @if (!empty($heroStats))
                <div class="karaoke-shell karaoke-hero__stats-wrap">
                    <div class="karaoke-hero__stats">
                        @foreach ($heroStats as $stat)
                            <div class="karaoke-hero__stat">
                                @if (!empty($stat['value']))
                                    <strong>{{ $stat['value'] }}</strong>
                                @endif
                                @if (!empty($stat['label']))
                                    <span>{{ $stat['label'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @endif

    @if ($introWidget)
        <section class="karaoke-intro">
            <div class="karaoke-shell">
                <div class="karaoke-intro__grid">
                    @if (!empty($introImages))
                        <div class="karaoke-intro__media">
                            @foreach (array_slice($introImages, 0, 2) as $key => $image)
                                <div class="karaoke-intro__image karaoke-intro__image--{{ $key + 1 }}">
                                    <img src="{{ $image }}"
                                        alt="{{ $introDescription['title'] ?? ($introWidget->name ?? '') }}"
                                        loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="karaoke-intro__content">
                        @if (!empty($introDescription['title']))
                            <h2>{{ $introDescription['title'] }}</h2>
                        @endif
                        @if (!empty($introDescription['subtitle']))
                            <div class="karaoke-intro__subtitle">{{ $introDescription['subtitle'] }}</div>
                        @endif
                        @if (!empty($introDescription['body']))
                            <div class="karaoke-intro__body">{!! nl2br(e($introDescription['body'])) !!}</div>
                        @endif
                        @if (!empty($introFeatures))
                            <div class="karaoke-intro__features">
                                @foreach ($introFeatures as $feature)
                                    <div class="karaoke-intro__feature">
                                        @if (!empty($feature['icon']))
                                            <span><i class="{{ $feature['icon'] }}"></i></span>
                                        @endif
                                        @if (!empty($feature['label']))
                                            <strong>{{ $feature['label'] }}</strong>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (!empty($introAction['label']))
                            <a class="karaoke-btn karaoke-btn--wide" href="{{ $introAction['url'] ?? '#' }}">
                                <span>{{ $introAction['label'] }}</span>
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                @if (!empty($introServices))
                    <div class="karaoke-intro__services">
                        @foreach ($introServices as $service)
                            <div class="karaoke-intro__service">
                                @if (!empty($service['icon']))
                                    <span><i class="{{ $service['icon'] }}"></i></span>
                                @endif
                                @if (!empty($service['label']))
                                    <strong>{{ $service['label'] }}</strong>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if ($constructionWidget)
        <section class="karaoke-card-section karaoke-card-section--construction">
            @if (!empty($constructionData['background']))
                <img class="karaoke-section-bg" src="{{ $constructionData['background'] }}"
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

    @if ($productWidget)
        <section class="karaoke-card-section karaoke-card-section--products">
            @if (!empty($productData['background']))
                <img class="karaoke-section-bg" src="{{ $productData['background'] }}"
                    alt="{{ $productData['title'] ?? ($productWidget->name ?? '') }}" loading="lazy">
            @endif
            <div class="karaoke-card-section__overlay"></div>
            <div class="karaoke-shell">
                @if (!empty($productData['title']))
                    <header class="karaoke-section-heading">
                        <span></span>
                        <h2>{{ $productData['title'] }}</h2>
                        <span></span>
                    </header>
                @endif
                @if ($productCards->isNotEmpty())
                    <div class="karaoke-product-grid">
                        @foreach ($productCards as $card)
                            @php
                                $cardTitle = $objectName($card);
                                $cardImage = $card->image ?? '';
                                $cardDescription = strip_tags($objectDescription($card));
                                $cardUrl = $objectUrl($card);
                                $cardLabel = $productData['card_link_label'] ?? '';
                            @endphp
                            <article class="karaoke-product-card">
                                <a class="karaoke-product-card__image" href="{{ $cardUrl }}"
                                    title="{{ $cardTitle }}">
                                    @if ($cardImage)
                                        <img src="{{ $imageUrl($cardImage, $loop->index) }}" alt="{{ $cardTitle }}"
                                            loading="lazy">
                                    @endif
                                </a>
                                <div class="karaoke-product-card__body">
                                    @if ($cardTitle)
                                        <h3><a href="{{ $cardUrl }}"
                                                title="{{ $cardTitle }}">{{ $cardTitle }}</a></h3>
                                    @endif
                                    @if ($cardDescription)
                                        <p>{{ $cardDescription }}</p>
                                    @endif
                                    @if ($cardLabel)
                                        <a class="karaoke-product-card__link"
                                            href="{{ $cardUrl }}">{{ $cardLabel }}</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
                @if (!empty($productData['action']['label']))
                    <div class="karaoke-section-action">
                        <a class="karaoke-btn karaoke-btn--wide" href="{{ $productData['action']['url'] ?? '#' }}">
                            <span>{{ $productData['action']['label'] }}</span>
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if (!empty($slides['home-banner']['item']))
        <section class="home-banner-section">
            @foreach ($slides['home-banner']['item'] as $slide)
                <div class="banner-item">
                    <a href="{{ $slide['url'] ?? '#' }}" target="{{ $slide['target'] ?? '_self' }}">
                        <img src="{{ asset($slide['image']) }}" alt="{{ $slide['title'] ?? 'Banner' }}"
                            loading="lazy">
                    </a>
                </div>
            @endforeach
        </section>
    @endif
    @php
        $homeDesigns1 = $widgets['home-designs-1'] ?? null;
        $homeDesigns2 = $widgets['home-designs-2'] ?? null;
        $homeNews1 = $widgets['home-news-1'] ?? null;
        $homeNews2 = $widgets['home-news-2'] ?? null;
        $homeNews3 = $widgets['home-news-3'] ?? null;

        $designsTabs = [
            [
                'key' => 'tab1',
                'label' => $homeDesigns1->name ?? 'Thiết kế karaoke',
                'active' => true,
                'widget' => $homeDesigns1,
            ],
            [
                'key' => 'tab2',
                'label' => $homeDesigns2->name ?? 'Tư vấn thiết kế',
                'active' => false,
                'widget' => $homeDesigns2,
            ],
        ];
    @endphp
    @if ($homeDesigns1 || $homeDesigns2)
        <section class="home-designs">
            <div class="karaoke-shell">
                <div class="tabs">
                    @foreach ($designsTabs as $tab)
                        @if ($tab['widget'])
                            <button class="tab {{ $tab['active'] ? 'active' : '' }}" type="button"
                                data-home-design-tab="{{ $tab['key'] }}">{{ $tab['label'] }}</button>
                        @endif
                    @endforeach
                </div>

                @foreach ($designsTabs as $tab)
                    @if ($tab['widget'])
                        @php
                            $widget = $tab['widget'];
                            $desc = is_string($widget->description)
                                ? json_decode($widget->description, true)
                                : $widget->description ?? [];
                            $desc = $desc[$languageId] ?? ($desc['1'] ?? $desc);
                            $limit = $desc['limit'] ?? 6;

                            $tabCards = collect();
                            if ($widget->model === 'PostCatalogue') {
                                $tabCards = collect($widget->object ?? [])->flatMap(fn($c) => collect($c->posts ?? []));
                            } elseif ($widget->model === 'Post') {
                                $tabCards = collect($widget->object ?? []);
                            }
                            $tabCards = $tabCards->take($limit);
                        @endphp
                        <div class="grid home-designs__panel {{ $tab['active'] ? 'active' : '' }}"
                            data-home-design-panel="{{ $tab['key'] }}">
                            @foreach ($tabCards as $card)
                                @php
                                    $cardTitle = $objectName($card);
                                    $cardDescription = strip_tags($objectDescription($card));
                                    $cardUrl = $objectUrl($card);
                                @endphp
                                <div class="card">
                                    <div class="image-wrapper">
                                        <a href="{{ $cardUrl }}">
                                            <img src="{{ $imageUrl($card->image ?? '', $loop->index) }}"
                                                alt="{{ $cardTitle }}" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="title">{{ $cardTitle }}</div>
                                    <div class="description">{{ Str::limit($cardDescription, 120) }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach

                <div class="action">
                    <a href="#" class="btn-more">Xem thêm <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </section>
    @endif

    @php
        $newsCols = [$homeNews1, $homeNews2, $homeNews3];
        $newsCols = array_filter($newsCols);
    @endphp

    @if (!empty($newsCols))
        <section class="home-news">
            <div class="karaoke-shell">
                <header class="karaoke-section-heading">
                    <span></span>
                    <h2>Tin tức - Kinh nghiệm - Hỏi đáp</h2>
                    <span></span>
                </header>

                <div class="grid">
                    @foreach ($newsCols as $widget)
                        @php
                            $desc = is_string($widget->description)
                                ? json_decode($widget->description, true)
                                : $widget->description ?? [];
                            $desc = $desc[$languageId] ?? ($desc['1'] ?? $desc);
                            $limit = $desc['limit'] ?? 7;

                            $posts = collect();
                            if ($widget->model === 'PostCatalogue') {
                                $posts = collect($widget->object ?? [])->flatMap(fn($c) => collect($c->posts ?? []));
                            } elseif ($widget->model === 'Post') {
                                $posts = collect($widget->object ?? []);
                            }
                            $posts = $posts->take($limit);

                            $feature = $posts->first();
                            $listPosts = $posts->slice(1)->take(max($limit - 1, 0));
                            $featureTitle = $feature ? $objectName($feature) : '';
                            $featureUrl = $feature ? $objectUrl($feature) : '#';
                        @endphp
                        <div class="column">
                            <div class="col-header">{{ $widget->name }}</div>
                            @if ($feature)
                                <div class="image-wrapper with-corners">
                                    <a href="{{ $featureUrl }}">
                                        <img src="{{ $imageUrl($feature->image ?? '', $loop->index) }}"
                                            alt="{{ $featureTitle }}" loading="lazy">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="card-title" href="{{ $featureUrl }}">{{ $featureTitle }}</a>
                                    @if ($listPosts->isNotEmpty())
                                        <ul class="news-list">
                                            @foreach ($listPosts as $listObject)
                                                <li><a
                                                        href="{{ $objectUrl($listObject) }}">{{ $objectName($listObject) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</main>
