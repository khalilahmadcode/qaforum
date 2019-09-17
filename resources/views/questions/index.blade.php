@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h2>All Questions</h2>
                        
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Create New Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {{-- messages --}}
                    @include('layouts._messages')

                    {{-- Quetions --}}
                    @forelse ($questions as $question)
                        <div class="media post">
                            <div class="d-flex flex-column counters">
                                {{-- votes count --}}
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong>{{ str_plural('Vote', $question->votes_count ) }}
                                </div>
                                {{-- answers count --}}
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers_count  }}</strong>{{ str_plural('Answer', $question->answers_count) }}
                                </div>
                                {{-- Views count --}}
                                <div class="view">
                                   {{ $question->views  . " ". str_plural('View', $question->views) }}
                                </div>
                            </div>

                            <div class="media-body">
                                <div class="align-item-center">
                                    <div class="row">

                                        {{-- title --}}
                                        <div class="col-sm-12 col-md-9">
                                            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                        </div>

                                        {{-- buttons --}}
                                        <div class="col-sm-12 col-md-3 text-right">
                                            <div class="">
                                                {{-- Authentication for updating question --}}
                                                @can('update', $question)
                                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                                @endcan
                                                
                                                {{-- Authentication for deleting question --}}
                                                @can('delete', $question)
                                                    <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- author --}}
                                @include('share._author', [
                                    'model'=>$question, 
                                    'label'=>'Questioned'
                                ])
                                
                                {{-- question body --}}
                                {{ $question->excerpt(300) }}
                            </div>
                        </div>
                        
                        @empty
                            <div class="alert alert-warning">
                                <strong>Sorry. There is no Question available.</strong>
                            </div>
                        
                    @endforelse
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
