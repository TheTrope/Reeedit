
@extends("default")
@section("title1", "Subs")
@section('content')
<div class="row">
  <div class="card-panel">
    @if(Session::has('user') and Session::get('user')->role == "ADMIN")
      <div class="right-align teal-text">
        <a href="/createsub"><b>+ Thread</b></a>
      </div>
    @endif
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
