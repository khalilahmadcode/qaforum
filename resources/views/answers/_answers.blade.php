<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                {{-- Number of answers  --}}
                <div class="card-title">
                    <h2>{{ $answersCount . " ". str_plural('Answer', $answersCount) }}</h2>
                </div>
                {{-- /Number of answers  --}}

                <hr>

                {{-- messages --}}
                @include('layouts._messages')

                {{-- List of answers --}}
                @Foreach ($answers as $answer)
                    <div class="media">
                        {{-- Votes controls --}}
                        <div class="d-flex flex-column vote-controls ">
                            <a href="" title="This answer is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x" ></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a href="" title="This answer is not useful" class="vote-up off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            {{-- best anser: who can do it --}}
                            @can('accept', $answer)
                                <a title="Mark this as best answer" 
                                    class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit(); "
                                    >
                                    <i class="fas fa-check fa-lg"></i>
                                </a>
                                <form action="{{ route('answers.accept', $answer->id) }}" id="accept-answer-{{ $answer->id }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                                @else 
                                    @if ($answer->is_best)
                                        <a title="Accepted as best answer" class="{{ $answer->status }} mt-2">
                                            <i class="fas fa-check fa-lg"></i>
                                        </a>
                                    @endif
                            @endcan
                        </div> 
                        {{-- /Votes controls --}}

                        {{-- Answers Content --}}
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            
                            <div class="d-flex align-item-center mt-4">
                                {{-- Authentication for updating answer --}}
                                @can('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                @endcan
                                
                                {{-- Authentication for deleting answer --}}
                                @can('delete', $answer)
                                    <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan

                                <div class="ml-auto">
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }} 
                                        <span class="text-muted ml-1">by </span> <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- /Answers Content --}}
                    </div>
                    <hr>
                @endforeach
                {{-- /List of answers --}}
            </div>
        </div>
    </div>
</div>