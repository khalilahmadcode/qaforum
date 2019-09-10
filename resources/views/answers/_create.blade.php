<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                {{-- Ansewr  --}}
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                {{-- / Answer  --}}

                <hr>

                {{-- Answers Form --}}
                <form action="{{ route( 'questions.answers.store', $question->id ) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid':'' }}" id="" cols="30" rows="5"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type='submit' class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
                {{-- /Answer Form --}}
            </div>
        </div>
    </div>
</div>