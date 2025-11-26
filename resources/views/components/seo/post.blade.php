@props(['post'])

<meta name="description" content="{{ $post->seo_description }}">

@php $keywords = $post->getMeta('seo_keywords'); @endphp
@if(!empty($keywords))
    <meta name="keywords" content="{{ $keywords }}">
@endif
@endif

<link rel="canonical" href="{{ $post->seo_canonical }}">

{{-- Open Graph --}}
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $post->seo_og_title }}">
<meta property="og:description" content="{{ $post->seo_og_description }}">
<meta property="og:url" content="{{ $post->seo_canonical }}">
@if($post->seo_og_image)
    <meta property="og:image" content="{{ $post->seo_og_image }}">
@endif

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->getMeta('seo_twitter_title', $post->seo_title) }}">
<meta name="twitter:description" content="{{ $post->getMeta('seo_twitter_description', $post->seo_description) }}">

@php
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->seo_title,
        'description' => $post->seo_description,
        'image' => $post->seo_og_image,
        'datePublished' => $post->created_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $post->user->name,
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $post->seo_canonical,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Artemis Journal',
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
</script>
