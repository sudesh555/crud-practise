@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            Welcome, {{ Auth::user()->name }}
            <h2>All Users</h2>
            <ul>
                @foreach($users as $user)
                <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection