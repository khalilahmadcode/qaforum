<a title="Click to mark ans favorite Question (Click again to undo)" 
    class="favorite mt-2 {{ Auth::guest() ? 'off' : ( $model->is_favorited ? 'favorited' : '') }}"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
    >
    <form action="/questions/{{ $model->id }}/favorites" id="favorite-question-{{ $model->id }}" method="POST" style="display:none;">
        @csrf
        
        {{-- delete method  --}}
        @if ($model->is_favorited)
            @method('DELETE')
        @endif
    </form>
    <i class="fas fa-star fa-2x"></i>
</a>
<span class="favorites-count">{{ $model->favorites_count }}</span>