@if($answersCount > 0)
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
                        <div class="media post">
    
                            {{-- Votes control for each answer --}}
                            @include('share._vote', [
                                'model' => $answer
                            ])
    
                            <div class="media-body">
                                 {{-- Answers Content --}}
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
    
                                    {{-- author --}}
                                    @include('share._author', [
                                        'model'=>$answer, 
                                        'label'=>'Answered'
                                    ])
                                </div>
    
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif