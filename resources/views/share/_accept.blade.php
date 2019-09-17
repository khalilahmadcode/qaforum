@can('accept', $model)
    <a title="Mark this as best answer" 
        class="{{ $model->status }} mt-2"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit(); "
        >
        <i class="fas fa-check fa-lg"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id) }}" id="accept-answer-{{ $model->id }}" method="POST" style="display:none;">
        @csrf
    </form>
    @else 
        @if ($model->is_best)
            <a title="Accepted as best answer" class="{{ $model->status }} mt-2">
                <i class="fas fa-check fa-lg"></i>
            </a>
        @endif
@endcan