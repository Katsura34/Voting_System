@extends('layouts.app')

@section('content')
<div class="bg-white shadow-sm p-4 rounded max-w-md mx-auto">
    <h3 class="fw-bold text-secondary mb-4">Edit Party</h3>

    <form method="POST" action="{{ route('parties.update', $party) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Party Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $party->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Slogan</label>
            <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $party->slogan) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            @if($party->logo)
                <img src="{{ asset('storage/'.$party->logo) }}" width="80" height="80" class="rounded mb-2">
            @endif
            <input type="file" name="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update Party</button>
        <a href="{{ route('parties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
