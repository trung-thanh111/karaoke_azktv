@php
    $languageId = $config['language'] ?? 1;
    $servicesWidget = $widgets['about-services'] ?? null;
    $services = collect($servicesWidget->object ?? []);
    $servicesDesc = $servicesWidget ? ($servicesWidget->description[$languageId] ?? ($servicesWidget->description['1'] ?? '')) : '';
    if (is_string($servicesDesc)) {
        $cleanedDesc = html_entity_decode(strip_tags($servicesDesc));
        $decoded = json_decode($cleanedDesc, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $servicesDesc = $decoded;
        } else {
            $servicesDesc = $cleanedDesc;
        }
    }
    $servicesDescription = is_array($servicesDesc) ? ($servicesDesc['body'] ?? '') : $servicesDesc;
    $servicesBg = isset($servicesWidget->album) && is_array($servicesWidget->album) ? ($servicesWidget->album[0] ?? '/userfiles/image/home/karaoke-section-bg.png') : '/userfiles/image/home/karaoke-section-bg.png';
@endphp

@if($servicesWidget && $services->isNotEmpty())
<section class="karaoke-card-section karaoke-card-section--services">
    <img class="karaoke-section-bg" src="{{ asset($servicesBg) }}" alt="Dịch vụ của chúng tôi" loading="lazy">
    <div class="karaoke-card-section__overlay"></div>

    <div class="karaoke-shell">
        <header class="karaoke-section-heading">
            <span></span>
            <h2>Dịch vụ của chúng tôi</h2>
            <span></span>
        </header>

        @if(!empty($servicesDescription))
            <div class="karaoke-services-description">{!! $servicesDescription !!}</div>
        @endif

        <div class="karaoke-services-grid">
            @foreach($services as $service)
                @php
                    if (is_object($service)) {
                        $title = $service->short_name ?? ($service->languages->first()->pivot->name ?? '');
                        $icon = $service->icon ?? '';
                    } else {
                        $title = $service['label'] ?? '';
                        $icon = $service['icon'] ?? '';
                    }
                @endphp
                @if($title)
                    <article class="karaoke-service-card">
                        <span class="karaoke-service-card__icon">
                            @if($icon)
                                <i class="{{ $icon }}"></i>
                            @endif
                        </span>
                        <strong>{{ $title }}</strong>
                    </article>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
