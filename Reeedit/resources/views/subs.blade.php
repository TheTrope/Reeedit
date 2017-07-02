
@extends("default")
@section("title1", "Subs")
@section('content')
<div class="row">
  <div class="card-panel">
    @foreach ($subs as $sub)
    <a href="/threads/{{ $sub->id }}">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">

          <span class="card-title">{{ $sub->name }}</span>
          <p>
            {{ $sub->description }}
          </p>

        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
@stop
