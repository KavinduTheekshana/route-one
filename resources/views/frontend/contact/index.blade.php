@extends('layouts.frontend')

@section('content')
@section('page_name', 'Contact Us')
@include('frontend.components.hero')
@include('frontend.contact.form')
@include('frontend.contact.map')


@endsection
