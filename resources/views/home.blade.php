@extends('layouts.app')

@php
    $most_popular_viewed = collect($most_popular_viewed['results'] ?? []);
    $most_popular_emailed = collect($most_popular_emailed['results'] ?? []);
    $most_popular_shared = collect($most_popular_shared['results'] ?? []);

    $slides = collect([]);
    $item = $most_popular_viewed->first() ?? null;
    $most_popular_viewed = $most_popular_viewed->slice(1);
    if ($item) {
        $slides->push($item);
    }

    $item = $most_popular_emailed->first() ?? null;
    $most_popular_emailed = $most_popular_emailed->slice(1);
    if ($item) {
        $slides->push($item);
    }

    $item = $most_popular_shared->first() ?? null;
    $most_popular_shared = $most_popular_shared->slice(1);
    if ($item) {
        $slides->push($item);
    }
@endphp

@section('content')
    <div class="container mb-5">
        <div class="main-slider owl-single owl-carousel">
            @foreach ($slides as $item)
                <div class="huge-article d-md-flex">
                    <div class="img-wrap">
                        <a href="#"><img
                                src="{{ $item['media'][0]['media-metadata'][2]['url'] ?? '/images/no-photo.jpg' }}"
                                alt="Image" class="img-fluid"></a>
                    </div>
                    <div class="text-wrap">
                        <div class="meta`">
                            @isset($item['published_date'])
                                <span class="d-inline-block">{{ $item['published_date'] }}</span>
                            @endisset
                            {{-- <span class="mx-2">&bullet;</span>
                        <span><a href="#">2 Comments</a></span> --}}
                        </div>
                        <h3><a href="#">{{ $item['title'] }}</a></h3>
                        <p>{{ $item['abstract'] }}</p>
                        <div class="author d-flex align-items-center">
                            {{-- <div class="img mr-3">
                            <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                        </div> --}}
                            <div class="text">
                                <h3><a href="#">{{ $item['byline'] }}</a></h3>
                                <strong>{{ $item['section'] }} /
                                    {{ $item['subsection'] }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- item -->
        </div>
    </div>

    <div class="section-latest">
        <div class="container">
            <div class="row gutter-v1 align-items-stretch mb-5">
                <div class="col-12">
                    <h2 class="section-title"><a href="/most-viewed">Most Viewed Articles</a></h2>
                </div>
                <div class="col-md-9 pr-md-5">
                    <div class="row">
                        @foreach ($most_popular_viewed->take(5) as $item)
                            <div class="col-12">
                                <div class="post-entry horizontal d-md-flex article" data-id="{{ $item['id'] }}">
                                    <div class="media">
                                        <a href="#">
                                            <img src="{{ $item['media'][0]['media-metadata'][2]['url'] ?? '/images/no-photo.jpg' }}"
                                                alt="Image" class="img-fluid">
                                        </a>
                                        @if(isArticleSaved($item['id']))
                                            <span class="save-article" data-content="9733">&#9733;</span>
                                        @else
                                            <span class="save-article" data-content="9734">&#9734;</span>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <div class="meta">
                                            @isset($item['published_date'])
                                                <span>{{ $item['published_date'] }}</span>
                                            @endisset
                                            {{-- <span>&bullet;</span>
                                                <span>5 mins read</span> --}}
                                        </div>
                                        <h2><a href="#">{{ $item['title'] }}</a></h2>
                                        <p>{{ $item['abstract'] }}</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-title"><a href="/most-emailed">Most Emailed Articles</a></h2>
                        </div>
                        @foreach ($most_popular_emailed->take(3) as $item)
                            <div class="col-md-4 col-lg-4">
                                <div class="post-entry article" data-id="{{ $item['id'] }}">
                                    <div class="media">
                                        <a href="#">
                                            <img src="{{ $item['media'][0]['media-metadata'][2]['url'] ?? '/images/no-photo.jpg' }}"
                                                alt="Image" class="img-fluid">
                                        </a>
                                        @if(isArticleSaved($item['id']))
                                            <span class="save-article" data-content="9733">&#9733;</span>
                                        @else
                                            <span class="save-article" data-content="9734">&#9734;</span>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <div class="meta-cat">{{ $item['section'] }} / {{ $item['subsection'] }}</div>
                                        <h2><a href="#">{{ $item['title'] }}</a></h2>
                                        <div class="meta">
                                            @isset($item['published_date'])
                                                <span>{{ $item['published_date'] }}</span>
                                            @endisset
                                            {{-- <span>&bullet;</span>
                                        <span>5 mins read</span> --}}
                                        </div>
                                        <p>{{ $item['section'] }}</p>

                                    </div>
                                    <div class="author d-flex align-items-center">
                                        <div class="text">
                                            <h3><a href="#">{{ $item['byline'] }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-title"><a href="/most-shared">Most Shared Articles</a></h2>
                        </div>
                        @foreach ($most_popular_shared->take(3) as $item)
                            <div class="col-md-4 col-lg-4">
                                <div class="post-entry article" data-id="{{ $item['id'] }}">
                                    <div class="media">
                                        <a href="#">
                                            <img src="{{ $item['media'][0]['media-metadata'][2]['url'] ?? '/images/no-photo.jpg' }}"
                                                alt="Image" class="img-fluid">
                                        </a>

                                        @if(isArticleSaved($item['id']))
                                            <span class="save-article" data-content="9733">&#9733;</span>
                                        @else
                                            <span class="save-article" data-content="9734">&#9734;</span>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <div class="meta-cat">{{ $item['section'] }} / {{ $item['subsection'] }}</div>
                                        <h2><a href="#">{{ $item['title'] }}</a></h2>
                                        <div class="meta">
                                            @isset($item['published_date'])
                                                <span>{{ $item['published_date'] }}</span>
                                            @endisset
                                            {{-- <span>&bullet;</span>
                                      <span>5 mins read</span> --}}
                                        </div>
                                        <p>{{ $item['section'] }}</p>

                                    </div>
                                    <div class="author d-flex align-items-center">
                                        <div class="text">
                                            <h3><a href="#">{{ $item['byline'] }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
