@push('styles')
@endpush

@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    @section('page_name', 'Create User')
    @include('backend.components.breadcrumb')
</div>

@include('backend.components.alert')



@include('backend.user.create.userDetails')
@include('backend.user.create.documents')






@endsection

@push('scripts')
@endpush
