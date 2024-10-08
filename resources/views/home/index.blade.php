@extends('layouts.web')

@section('body')

    <div class="intro relative">
        @include('home.partial.hero')
    </div>

    <div class="max-w-6xl mx-auto p-3 sm:px-8 md:p-10 xl:px-0">
        @include('home.partial.reviews')

        @include('home.partial.box1')

        @include('home.partial.cards-default')

        @include('home.partial.box2')

        @include('home.partial.cards-elongated')

        @include('home.partial.deals')

        @include('home.partial.faqs')

        <div class="lg:px-10">

            @include('home.partial.why-iceland')

            @include('home.partial.feature1')
            
            @include('home.partial.feature2')

            @include('home.partial.testimonials')

            <div class="pt-22 md:pt-56">
                @include('home.partial.location-map')
            </div>
            
        </div>
    </div>
    
@endsection
