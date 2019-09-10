@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h1>{{ $question->title }}</h1>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body text-justify">
                    {!! $question->body_html !!}
                    <div class="float-right">
                        <span class="text-muted">
                            Questioned {{ $question->created_date }} 
                            <span class="text-muted ml-1">by </span> <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count. " ". str_plural('Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    @Foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }} 
                                        <span class="text-muted ml-1">by </span> <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
