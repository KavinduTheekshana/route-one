@extends('layouts.frontend')

@section('content')
    @include('frontend.home.slider')
    @include('frontend.home.about')
    @include('frontend.home.service')

    @include('frontend.home.benefits')
    @include('frontend.home.testimonial')

    {{-- @include('frontend.home.contact') --}}
    @include('frontend.home.companies')











@endsection
