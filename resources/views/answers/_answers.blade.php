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

                            <a href="" title="Mark this as best answer" class="vote-accepted mt-2">
                                <i class="fas fa-check fa-lg"></i>
                            </a>
                        </div> 
                        {{-- /Votes controls --}}

                        {{-- Answers Content --}}
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Answered {{ $answer->created_date }} 
                                    <span class="text-muted ml-1">by </span> <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                </span>
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