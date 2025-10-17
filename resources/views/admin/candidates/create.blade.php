@extends('layouts.app')

@section('content')
<div class="card shadow-sm rounded mx-auto my-5" style="max-width: 530px;">
    <div class="card-body">
        <h1 class="h4 fw-semibold text-secondary mb-4">Add New Candidate</h1>
        
        <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="form-label text-secondary">Candidate Name</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    required>
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Party / Group</label>
                <select name="party_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="">-- Select Party --</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}" 
                            {{ old('party_id', $candidate->party_id ?? '') == $party->id ? 'selected' : '' }}>
                            {{ $party->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-4">
                <label class="form-label text-secondary">Position</label>
                <select name="position_id"
                    class="form-select @error('position_id') is-invalid @enderror" required>
                    <option value="">-- Select Position --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                @error('position_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Photo</label>
                <input type="file" name="photo"
                    class="form-control @error('photo') is-invalid @enderror"
                    accept="image/*">
                <div class="form-text">Upload a photo for the candidate (optional)</div>
                @error('photo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary">Description</label>
                <textarea name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="3"
                    placeholder="Enter candidate description (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('candidates.index') }}" class="text-secondary text-decoration-underline">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    Save Candidate
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
