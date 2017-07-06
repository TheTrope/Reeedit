@extends("default")
@section("title1", "Subs")
@section("titlelinkl", "/subs")
@section("title2", $data['sub']->name)
@section('content')
<div class="row">
  <div class="card-panel">
    <div class="card-content">
      <div class="right-align teal-text">
        <a href="/createthread"><b>+ Thread</b></a>
      </div>
      @foreach ($data['threads'] as $thread)
      <a href="/thread/{{ $thread->id }}">
        <div class="card blue-grey darken-1 ">
          <div class="card-content white-text">

            <span class="card-title">{{ $thread->name }}

                @if($thread->votes != 0)
                <span class="badge teal white-text">
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
      @if (count($data['threads']) <= 0)
        This sub has no threads
      @endif
    </div>
  </div>
</div>
@stop
