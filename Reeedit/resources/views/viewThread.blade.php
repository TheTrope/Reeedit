
@extends("default")
@section("title1", "Thread")
@section('content')
<div class="row">
  <div class="card-panel">
    <a href="/thread/{{ $sub->id }}">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">

          <span class="card-title">{{ $thread->name }}</span>
          <p>
          </p>

        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
@stop
