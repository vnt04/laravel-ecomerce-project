@extends('layouts.app')

@section('content')
<h1>Login</h1>

@if($errors->any())
    <div style="color:red">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/login') }}" method="POST">
    @csrf
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

<p>Don't have account? <a href="{{ route('register') }}">Register</a></p>
@endsection
