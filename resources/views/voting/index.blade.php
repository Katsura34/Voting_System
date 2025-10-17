@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Welcome, {{ auth()->user()->first_name }}!</h1>
    <p>This is the voting page.</p>
</div>
@endsection
