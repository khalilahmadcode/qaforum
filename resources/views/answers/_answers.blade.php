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
                            {{-- vote up --}}
                            <a title="This answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-caret-up fa-3x" ></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote" id="up-vote-answer-{{ $answer->id }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            

                            {{-- vote count --}}
                            <span class="votes-count">{{ $answer->votes_count }}</span>

                            {{-- vote down --}}
                            <a title="This answer is not useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" 
                            onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote" id="down-vote-answer-{{ $answer->id }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            {{-- mark as best answer --}}
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