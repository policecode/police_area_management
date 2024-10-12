@extends('layouts.client')

@section('content')
    <main>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 col-md-8 col-lg-9 mb-3">
                    <div class="head-title-global d-flex justify-content-between mb-2">
                        <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                <span class="d-block text-decoration-none text-dark fs-4 category-name"
                                    title="{{$author['name']}}">{{$author['name']}}</span>
                            </h2>
                        </div>
                    </div>
                    <div class="list-story-in-category section-stories-hot__list">
                        @foreach ($records as $item)
                            <div class="story-item">
                                <a href="{{ route('client.story', ['story_slug' =>  $item['slug']]) }}" class="d-block text-decoration-none">
                                    <div class="story-item__image">
                                        <img src="{{$item['thumbnail']}}" alt="{{$item['title']}}" class="img-fluid" width="150"
                                            height="230" loading="lazy">
                                    </div>
                                    <h3 class="story-item__name text-one-row story-name">{{$item['title']}}</h3>

                                    <div class="list-badge">
                                        @if ($item['status'] == 1)
                                            <span class="story-item__badge badge text-bg-success">Full</span>
                                        @endif
                                        @if ($item['star_average'] > 7)
                                            <span class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>
                                        @endif
                                        @if ($item['after_day'] < 30)
                                            <span class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @include('parts.template.paging_client')
                </div>
                <div class="col-12 col-md-4 col-lg-3 sticky-md-top">
                    <div class="category-description bg-light p-2 rounded mb-3 card-custom">
                        <p class="mb-0 text-secondary">{{$author['name']}}</p>
                        {!!$author['description']!!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
@endsection
