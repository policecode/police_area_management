@extends('layouts.client')

@section('content')
    <main>
        <div class="container">
            <div class="row align-items-start">
                @include('client_page.part_stories.story_information', [])
            
                <div class="col-12 col-md-5 col-lg-4">
                    @include('client_page.part_stories.story_top_ratings', [])
                    @include('client_page.part_stories.table_categories', [])
                </div>
            </div>



        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('frontend/js/story.js')}}"></script>
@endsection
