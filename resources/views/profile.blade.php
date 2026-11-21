@extends('layouts.site')

@section('title', 'Profile')

@section('content')
    <section class="content-card">
        <h1>Developer Profile</h1>

        @if ($user)
            <p><strong>Username:</strong> jvmbeasca</p>
            <p><strong>Full name:</strong> John Vincent Beasca</p>
            <p><strong>Email:</strong> jmbeasca@fit.edu.ph</p>
        @else
            <p>No profile has been added yet.</p>
        @endif
    </section>
@endsection