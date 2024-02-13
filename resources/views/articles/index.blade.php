@extends('layouts.app')

@section('content')
    <div class="section-latest">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <form id="searchForm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-black" for="fname">First name</label>
                                    <input type="search" id="s" name="s" class="form-control"
                                        placeholder="Enter keyword and hit enter..." value="{{ $s }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-black" for="select">Sections</label>

                                    <select id="selected_section" name="selected_section" class="custom-select">
                                        <option value=""></option>
                                        @foreach ($sections as $item)
                                            <option value="{{ $item }}"
                                                {{ $selectedSection === $item ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-black" for="select">Authors</label>

                                    <select id="selected_author" name="selected_author" class="custom-select">
                                        <option value=""></option>
                                        @foreach ($bylines as $item)
                                            <option value="{{ $item }}"
                                                {{ $selectedByline === $item ? 'selected' : '' }}>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-black" for="select">Type</label>

                                    <select id="selected_type" name="selected_type" class="custom-select">
                                        <option value=""></option>
                                        @foreach ($types as $item)
                                            <option value="{{ $item }}"
                                                {{ $selectedType === $item ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary-hover-outline">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-title">{{ $title }}</h2>
                        </div>
                        @isset($articles)
                            @foreach ($articles as $item)
                                <div class="col-md-4 col-lg-4">
                                    <div class="post-entry article" data-id="{{ $item['id'] }}">
                                        <div class="media">
                                            <a href="#">
                                                <img src="{{ $item['media'][0]['media-metadata'][2]['url'] ?? '/images/no-photo.jpg' }}"
                                                    alt="Image" class="img-fluid">
                                            </a>
                                            
                                            <button class="save-article">Save Article</button>
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
                        @endisset

                        <div class="col-12">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
