{{-- 
    KOMPONENT: Linki społecznościowe
    Użycie: <x-social-links :links="config('site.social')" />
    
    Props:
    - links: tablica linków ['facebook' => 'url', 'instagram' => 'url', ...]
    - size: rozmiar ikon (sm, md, lg - domyślnie: md)
    - centered: czy wycentrowane (domyślnie: false)
--}}

@props([
    'links' => [],
    'size' => 'md',
    'centered' => false,
])

@php
$sizeClass = match($size) {
    'sm' => 'fs-6',
    'lg' => 'fs-4',
    default => 'fs-5',
};

$icons = [
    'facebook' => 'bi-facebook',
    'instagram' => 'bi-instagram',
    'linkedin' => 'bi-linkedin',
    'twitter' => 'bi-twitter-x',
    'youtube' => 'bi-youtube',
    'github' => 'bi-github',
    'tiktok' => 'bi-tiktok',
    'whatsapp' => 'bi-whatsapp',
];
@endphp

<div {{ $attributes->merge(['class' => 'footer-social d-flex gap-3' . ($centered ? ' justify-content-center' : '')]) }}>
    @foreach($links as $platform => $url)
        @if($url && isset($icons[$platform]))
        <a href="{{ $url }}" 
           target="_blank" 
           rel="noopener noreferrer" 
           aria-label="{{ ucfirst($platform) }}">
            <i class="bi {{ $icons[$platform] }}"></i>
        </a>
        @endif
    @endforeach
</div>
