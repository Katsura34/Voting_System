@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-4 p-5 mx-auto" style="max-width: 1100px;">
    <h1 class="display-5 fw-bold text-dark mb-4">
        Welcome back, Admin {{ auth()->user()->first_name }} 👋
    </h1>
    <p class="text-secondary mb-5">
        Here's a quick overview of your voting system. Use the panels below to manage positions,
        candidates, and view system insights.
    </p>
    
    <div class="row mb-5 g-4">
        <div class="col-12 col-md-4">
            <div class="card border-primary text-center shadow-sm h-100">
                <div class="card-body">
                    <h2 class="display-6 fw-bold text-primary mb-1">{{ \App\Models\Position::count() }}</h2>
                    <p class="text-secondary fw-medium mb-0">Positions</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-success text-center shadow-sm h-100">
                <div class="card-body">
                    <h2 class="display-6 fw-bold text-success mb-1">{{ \App\Models\Candidate::count() }}</h2>
                    <p class="text-secondary fw-medium mb-0">Candidates</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-purple text-center shadow-sm h-100" style="border-color: #6f42c1;">
                <div class="card-body">
                    <h2 class="display-6 fw-bold" style="color: #6f42c1;">{{ \App\Models\User::count() }}</h2>
                    <p class="text-secondary fw-medium mb-0">Registered Users</p>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row mb-4 g-4">
        <div class="col-12 col-lg-4">
            <a href="{{ route('positions.index') }}" class="card bg-primary text-white text-center shadow-sm p-4 text-decoration-none h-100 card-action-hover">
                <div class="card-body">
                    <h3 class="fw-semibold mb-2">Manage Positions</h3>
                    <p class="small">Add, edit, or delete election positions.</p>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <a href="{{ route('candidates.index') }}" class="card bg-success text-white text-center shadow-sm p-4 text-decoration-none h-100 card-action-hover">
                <div class="card-body">
                    <h3 class="fw-semibold mb-2">Manage Candidates</h3>
                    <p class="small">Register candidates and assign them to positions.</p>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <a href="{{ route('voting.index') }}" class="card text-white text-center shadow-sm p-4 text-decoration-none h-100" style="background-color: #6f42c1;">
                <div class="card-body">
                    <h3 class="fw-semibold mb-2">View Voting Page</h3>
                    <p class="small">Preview how the voting interface looks to users.</p>
                </div>
            </a>
        </div>
    </div>
   
</div>
@endsection
