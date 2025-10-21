@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="fw-bold text-primary mb-4">Cast Your Vote</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('voting.store') }}">
        @csrf
        @foreach($positions as $position)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white fw-semibold">
                    {{ $position->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($position->candidates->take(2) as $candidate)
                            <div class="col-md-6 col-lg-6 mb-3"> {{-- force 2 candidates max per position --}}
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        @if($candidate->photo)
                                            <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                 class="rounded-circle mb-2 object-fit-cover"
                                                 style="width:80px; height:80px;" alt="">
                                        @else
                                            <div class="rounded-circle bg-light d-inline-block mb-2"
                                                 style="width:80px; height:80px; line-height:80px;">
                                                <i class="bi bi-person fs-2 text-muted"></i>
                                            </div>
                                        @endif
                                        <h5 class="fw-semibold">{{ $candidate->name }}</h5>
                                        <p class="text-muted small mb-1">{{ $candidate->party->name ?? 'Independent' }}</p>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="radio"
                                                   name="votes[{{ $position->id }}]"
                                                   value="{{ $candidate->id }}"
                                                   required>
                                            <label class="form-check-label ms-2">Select</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($position->candidates->count() > 2)
                            <div class="text-muted small">Only 2 candidates are shown per position.</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-success px-5">
                <i class="bi bi-check-circle"></i> Submit Votes
            </button>
        </div>
    </form>
</div>
@endsection