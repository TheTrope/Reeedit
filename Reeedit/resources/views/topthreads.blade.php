@extends("default")
@section("title1", "Top threads")
@section('content')
<div class="row">
  <div class="card-panel">
    <div class="card-content">

      @foreach ($threads as $thread)
      <a href="/thread/{{ $thread->id }}">
        <div class="card blue-grey darken-1 ">
          <div class="card-content white-text">

            <span class="card-title">{{ $thread->name }}

                @if($thread->votes != 0)
                <span class="badge {{($thread->votes < 0) ? 'red lighten-2' : 'teal'}} white-text">
                  {{ $thread->votes }}
                  Votes
                </span>
                @endif
            </span>
            <p>
              @if (strlen($thread->description) > 40)
                {{ substr($thread->description, 0, 40) }}...
              @else
                {{ $thread->description }}
              @endif
            </p>
            <div class="right-align">
            </div>

          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
@stop
