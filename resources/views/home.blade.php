@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <span class="float-right">
                        Welcome {{ $user->name }}
                    </span>
                </div>
                
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-lg mb-2" href="{{ url('questions') }}">All Questions</a>
                    <div class="list-group">
                        <h3 class="list-group-item active">Questions List</h3>

                        @foreach ($questions as $question)
                            <div class="row mb-1 mt-1">
                                <div class="col-10">
                                    <h4 class="list-group-item list-group-item-action">
                                        <a href="{{ url('questions/'.$question->slug) }}">{{ $question->title }}</a>
                                    </h4>
                                </div>

                                <div class="col-2 item-align-right">
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                    <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
