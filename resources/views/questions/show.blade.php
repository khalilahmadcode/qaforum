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
                    <div class="media">

                        {{-- vote control --}}
                        @include('share._vote', [
                            'model'=>$question
                        ])

                        <div class="media-body">
                            {{-- body content --}}
                            {!! $question->body_html !!}

                            {{-- author info --}}
                            @include('share._author', [
                                'model'=>$question, 
                                'label'=>'Questioned'
                            ])
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
