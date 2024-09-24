@extends('layouts.frontend')

@section('content')
@section('page_name', 'About Us')
@include('frontend.components.hero')
@include('frontend.about.about')
@include('frontend.about.mission')
@include('frontend.about.why')
@include('frontend.about.testimonial')

@endsection
