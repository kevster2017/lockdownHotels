@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row d-flex align-items-center">
        <div class="col-sm-6">
            <strong>
                <h1 class="text-center">Welcome to Lockdown Hotels</h1>
            </strong>
            <p class="text-center">Want to find the perfect getaway? Come join us and find your dream hotel</p>
            <div class="row d-flex justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-info">Register</a>
            </div>
        </div>
        <div class="col-sm-6">
            <img class="img-thumbnail" src="/images/HotelsOpaque.PNG" alt="Logo">
        </div>
    </div>
</div>


@endsection