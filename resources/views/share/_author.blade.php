<div class="ml-auto">
    <span class="text-muted">
        {{ $label ." ". $model->created_date }} 
        <span class="text-muted ml-1">by </span> <a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </span>
</div>