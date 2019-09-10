@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="card-title">
                        <div class="d-flex align-item-center">
                            <h1>{{ $question->title }}</h1>
                            
                            <div class="ml-auto">
                                <a href="{{ $question->url }}" class="btn btn-outline-secondary">Back to all Answers</a>
                            </div>
                        </div>
                    </div>  {{--  card-title --}}
    
                    <hr>

                    {{-- media --}}
                    <div class="media text-justify">
                        <div class="d-flex flex-column vote-controls ">
                            <a href="" title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x" ></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a href="" title="This question is not useful" class="vote-up off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            <a href="" title="Click to mark ans favorite Question (Click again to undo)" class="favorite mt-2 favorited">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">1234</span>
                            </a>
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

                    <hr>
                    <h3>Update Your Answer</h3>
                    {{-- Answers Form --}}
                    <form action="{{ route( 'questions.answers.update', [$question->id, $answer->id] ) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid':'' }}" id="" rows="5">{{$answer->body}}</textarea>
                            
                            {{-- error --}}
                            @if ($errors->has('body'))
                                <div class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong>
                                    {{ old('body', $answer->body ) }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type='submit' class="btn btn-outline-primary">Update</button>
                        </div>

                    </form>
                    {{-- /Answer Form --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection