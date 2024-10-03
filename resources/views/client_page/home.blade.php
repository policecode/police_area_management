@extends('layouts.client')

@section('content')
    <main>
        @include('client_page.part_home.story_hot')
        @include('client_page.part_home.story_new')
        @include('client_page.part_home.story_full')
    </main>
@endsection

@section('scripts')
@endsection
