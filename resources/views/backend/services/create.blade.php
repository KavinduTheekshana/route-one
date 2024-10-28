@push('styles')
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Create Services')
    @include('backend.components.breadcrumb')


</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4">Create Service</h4>
    <div class="card-body p-16">
      <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
      method="POST" enctype="multipart/form-data" class="form-content pt-4">
    @csrf
    @if(isset($service))
        @method('PUT') <!-- This is needed for updating -->
    @endif

    <div class="row gy-20">
        <div class="col-xxl-12 col-md-12 col-sm-12">
            <div class="row g-20">
                <div class="col-sm-8">
                    <label for="service_name" class="h6 mb-8 fw-semibold font-heading">Service Name <span class="text-13 text-red fw-medium">*</span></label>
                    <div class="position-relative">
                        <input type="text" name="service_name"
                               class="text-counter placeholder-13 form-control py-11 pe-76"
                               placeholder="Service Name"
                               value="{{ old('service_name', isset($service) ? $service->service_name : '') }}">
                    </div>
                </div>

                <div class="col-sm-2">
                    <label for="price" class="h6 mb-8 fw-semibold font-heading">Price</label>
                    <div class="position-relative">
                        <input type="text" name="price"
                               class="text-counter placeholder-13 form-control py-11 pe-76"
                               placeholder="Price"
                               value="{{ old('price', isset($service) ? $service->price : '') }}">
                    </div>
                </div>

                <div class="col-sm-2">
                    <label for="currency" class="h6 mb-8 fw-semibold font-heading">Currency</label>
                    <div class="position-relative">
                        <select name="currency" class="form-select py-9 placeholder-13 text-15">
                            <option value="GBP" {{ (isset($service) && $service->currency == 'GBP') ? 'selected' : '' }}>GBP</option>
                            <option value="USD" {{ (isset($service) && $service->currency == 'USD') ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ (isset($service) && $service->currency == 'EUR') ? 'selected' : '' }}>EUR</option>
                            <option value="AUD" {{ (isset($service) && $service->currency == 'AUD') ? 'selected' : '' }}>AUD</option>
                            <option value="JPY" {{ (isset($service) && $service->currency == 'JPY') ? 'selected' : '' }}>JPY</option>
                        </select>
                    </div>
                </div>

                {{-- Meta Description --}}
                <div class="col-12">
                    <div class="editor">
                        <label for="review" class="h6 mb-8 fw-semibold font-heading">Service Description :
                            <span class="text-13 text-gray fw-medium">( Optional )</span></label>
                        <textarea placeholder="Service Description" name="description"
                                  class="form-control" rows="3">{{ old('description', isset($service) ? $service->description : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-align justify-content-end gap-8">
            <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
            <button type="submit" class="btn btn-main rounded-pill py-9">{{ isset($service) ? 'Update Service' : 'Create Service' }}</button>
        </div>
    </div>
</form>

    </div>

</div>








@endsection

@push('scripts')


@endpush
