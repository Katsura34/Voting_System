@extends('layouts.app')

@section('content')
<div class="card shadow-sm rounded mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 fw-semibold text-secondary">Candidates</h1>
            <a href="{{ route('candidates.create') }}" class="btn btn-primary">
                + Add Candidate
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 90px;">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Party</th>
                        <th scope="col">Position</th>
                        <th scope="col" class="text-center" style="width: 22%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($candidates as $candidate)
                        <tr>
                           
                            <td class="text-center">
                                @if($candidate->photo)
                                    <img src="{{ asset('storage/' . $candidate->photo) }}"
                                         alt="Candidate Photo"
                                         class="rounded-circle object-fit-cover mx-auto"
                                         style="width:60px; height:60px;">
                                @else
                                    <span class="text-secondary small">No Photo</span>
                                @endif
                            </td>

                          
                            <td>{{ $candidate->name }}</td>

                        
                            <td class="d-flex align-items-center gap-2">
                                @if($candidate->party)
                                    @if($candidate->party->logo)
                                        <img src="{{ asset('storage/' . $candidate->party->logo) }}"
                                             alt="Party Logo"
                                             class="rounded-circle object-fit-cover"
                                             style="width:35px; height:35px;">
                                    @endif
                                    <span>{{ $candidate->party->name }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                        
                            <td>{{ $candidate->position->name ?? '—' }}</td>

                          
                            <td class="text-center">
                                <a href="{{ route('candidates.edit', $candidate) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('candidates.destroy', $candidate) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this candidate?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary">No candidates found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
