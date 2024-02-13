@extends('layouts.app')

@section('content')
    <div class="section-latest">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="section-title">Saved Articles</h1>
                        </div>
                        @isset($savedArticles)
                            @foreach ($savedArticles as $item)
                                <div class="col-md-4 col-lg-4">
                                    1
                                </div>
                            @endforeach
                        @endisset

                        <div class="col-12">
                            {{ $savedArticles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
