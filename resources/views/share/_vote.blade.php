@if ($model instanceof App\Question)
    @php
        $name='question'; 
        $firstURISegment = 'questions'
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name='answer'; 
        $firstURISegment = 'answers'
    @endphp
@endif

@php
    $form_action = "/".$firstURISegment."/".$model->id."/vote";
    $form_id = $name ."-". $model->id; 
@endphp

<div class="d-flex flex-column vote-controls ">
    {{-- vote up --}}
    <a title="This {{ $name }} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault(); document.getElementById('up-vote-{{ $form_id }}').submit();">
        <i class="fas fa-caret-up fa-3x" ></i>
    </a>
    <form action="{{ $form_action }}" id="up-vote-{{ $form_id }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    

    {{-- vote count --}}
    <span class="votes-count">{{ $model->votes_count }}</span>

    {{-- vote down --}}
    <a title="This {{ $name }} is not useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-{{ $form_id }}').submit();">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="{{ $form_action }}" id="down-vote-{{ $form_id }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    {{-- if Question favorite /  if Answer accept --}}
    @if ($model instanceof App\Question)
        @include('share._favorite', [
            'model'=>$model
        ])
    @elseif($model instanceof App\Answer)
        @include('share._accept', [
            'model'=>$model
        ])
    @endif
</div> {{-- vote controls--}}