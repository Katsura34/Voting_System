@extends('layouts.app')

@section('content')
<div class="bg-white shadow-sm p-4 rounded">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-secondary">Parties</h3>
        <a href="{{ route('parties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Party
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Slogan</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parties as $party)
                <tr>
                    <td>
                        @if($party->logo)
                            <img src="{{ asset('storage/'.$party->logo) }}" alt="Logo" width="50" height="50" class="rounded-circle">
                        @else
                            <span class="text-muted">No Logo</span>
                        @endif
                    </td>
                    <td>{{ $party->name }}</td>
                    <td>{{ $party->slogan ?? '—' }}</td>
                    <td>
                        <a href="{{ route('parties.edit', $party) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('parties.destroy', $party) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this party?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No parties found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
