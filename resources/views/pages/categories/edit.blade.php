@extends('layouts.app')

@section('title', 'Edit Category')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <a href="{{ route('category.index') }}" class="btn btn-primary mr-3"><i class="fas fa-arrow-left"></i></a>
                <h1>Advanced Forms</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('category.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $category->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="description" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ $category->description }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="d-flex" style="gap: 1rem;">
                                    @if (Storage::disk('public')->fileExists($category->image))
                                        <img src="{{ Storage::url($category->image) }}" class="d-block rounded shadow"
                                            style="width: 5rem; height: 5rem;">
                                    @else
                                        <img src="{{ $category->image }}" class="d-block rounded shadow"
                                            style="width: 5rem; height: 5rem;">
                                    @endif
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input custom-cursor-default-hover @error('image') is-invalid @enderror"
                                            name="_image" id="customFile">
                                        <label class="custom-file-label custom-cursor-default-hover" for="customFile">Choose
                                            file</label>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
