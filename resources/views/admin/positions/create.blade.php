@extends('layouts.app')

@section('content')
<div class="card shadow-sm rounded mx-auto my-5" style="max-width: 480px;">
    <div class="card-body">
        <h1 class="h4 fw-semibold text-secondary mb-4">Add New Position</h1>

        <form method="POST" action="{{ route('positions.store') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label text-secondary">Position Name</label>
                <input type="text" name="name" 
                       value="{{ old('name') }}" 
                       class="form-control @error('name') is-invalid @enderror" 
                       required>
                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('positions.index') }}" class="text-secondary text-decoration-underline">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
