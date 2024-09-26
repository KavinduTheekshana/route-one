@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/job-card.css') }}">
@endpush


@extends('layouts.frontend')

@section('content')
@section('page_name', 'Job List')
@include('frontend.components.hero')
@include('frontend.jobs.job')


@endsection
