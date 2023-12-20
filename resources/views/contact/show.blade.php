@extends('layouts/app')

@section('content')
<!-- Page Content -->
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">All Messages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Message from {{ $contact->name }}</li>
        </ol>
    </nav>
</div>

<h1 class="text-center py-3">Message from {{ $contact->name }}</h1>

<div class="container">
    <div class="card">
        <div class="card-header">
            {{ $contact->name }}'s message
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $contact->email }}</h5>
            <p class="card-text">{{ $contact->message }}</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $contact->id }}">
                Delete Message
            </button>
            <!-- Modal -->
            <div class="modal fade" id="deleteModal{{ $contact->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to delete {{ $contact->name }}'s message?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Deleting is permanent and cannot be undone</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" action="{{ route('contact.destroy', $contact->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection