@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-item-center">
                            <h1>{{ $question->title }}</h1>
                            
                            {{-- <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question</a>
                            </div> --}}
                        </div>
                    </div>  {{--  card-title --}}

                    <hr>

                    <div class="media text-justify">
                        <div class="d-flex flex-column vote-controls ">
                            <a href="" title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x" ></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a href="" title="This question is not useful" class="vote-up off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            <a href="" title="Click to mark ans favorite Question (Click again to undo)" 
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ( $question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit(); "
                                >
                                <form action="/questions/{{ $question->id }}/favorites" id="favorite-question-{{ $question->id }}" method="POST" style="display:none;">
                                    @csrf
                                    
                                    {{-- delete method  --}}
                                    @if ($question->is_favorited)
                                        @method('DELETE')
                                    @endif
                                </form>
                                <i class="fas fa-star fa-2x"></i>
                            </a>
                            <span class="favorites-count">{{ $question->favorites_count }}</span>
                        </div> {{-- vote controls--}}

                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Questioned {{ $question->created_date }} 
                                    <span class="text-muted ml-1">by </span> <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                </span>
                            </div>
                        </div>
                    </div> {{-- media --}}
                </div>  {{-- card-body --}}
            </div> {{-- card-body --}}

        </div>
    </div>

    @include('answers._answers', [
        'answers'=> $question->answers,
        'answersCount'=>$question->answers_count 
    ])

    {{-- Answer form --}}
    @include('answers._create')
    
</div>
@endsection
