
@extends("default")
@section("title1", "Subs")
@section("title2", $data["thread"]->subName )
@section("title3",  $data["thread"]->name)
@section('content')

<div class="row">
  <div class="card-panel teal lighten-2">
    <div class="row">
      <div class="card">
        <div class="card-content">
        <span class="card-title">
          <b>  {{$data["thread"]->name }} </b>
        </span>
        &nbsp;&nbsp;&nbsp;&nbsp;
          {{ $data["thread"]->description }}
        </div>
            <div class="row"  style="margin: 10px">

                <div class="col s6 left-align">
                @if( $data['thread']->myVote == 1)
                  <a href="#"><i class="material-icons tiny green-text">thumb_up</i></a>
                @else
                  <a href="/thread/{{ $data['thread']->id }}/tvoteup"><i class="material-icons tiny grey-text">thumb_up</i></a>
                @endif
                <b> {{ (($data['thread']->votes > 0)? "+" : "") }}{{ $data['thread']->votes }} </b>
                @if( $data['thread']->myVote == -1)
                  <a href="#"><i class="material-icons tiny red-text">thumb_down</i></a>
                @else
                  <a href="/thread/{{ $data['thread']->id }}/tvotedown"><i class="material-icons tiny grey-text">thumb_down</i></a>
                @endif
                <a href="/answer/{{ $data['thread']->id }}/{{ $data['thread']->start }}" style="teal"><b>+</b></a>
                </div>
                <div class="col s6 right-align">
                  By <b>{{{$data['thread']->tauthor}}} </b> on {{$data['thread']->createdAt}}
                </div>
            </div>

      </div>
    </div>
    <div class="row">

      <div class="col s12">
    @foreach ($data["answers"] as $answer)
    <div class="row">
      <!-- {{ var_dump($data["answers"])}} -->

      @if($answer['depth'] > 0)
      <div class="card col offset-s{{ $answer['depth']}}  s{{ 12 - $answer['depth']}}" style="margin-top: -5px">
        @else
        <div class="card col s12">
          @endif
            <div class="card-content">
             &nbsp;&nbsp;&nbsp;&nbsp;{{{$answer['data']->content}}}
            </div>
            <div class="row"  style="margin: 5px">

                <div class="col s6 left-align">
                @if( $answer['data']->myVote == 1)
                  <a href="#"><i class="material-icons tiny green-text">thumb_up</i></a>
                @else
                  <a href="/thread/{{ $data['thread']->id }}/voteup/{{ $answer['data']->id }}"><i class="material-icons tiny grey-text">thumb_up</i></a>
                @endif
                <b> {{ (($answer['data']->votes > 0)? "+" : "") }}{{ $answer['data']->votes }} </b>
                @if( $answer['data']->myVote == -1)
                  <a href="#"><i class="material-icons tiny red-text">thumb_down</i></a>
                @else
                  <a href="/thread/{{ $data['thread']->id }}/votedown/{{ $answer['data']->id }}"><i class="material-icons tiny grey-text">thumb_down</i></a>
                @endif
                <a href="/answer/{{ $data['thread']->id }}/{{ $answer['data']->id }}" style="teal"><b>+</b></a>
                </div>
                <div class="col s6 right-align">
                  By <b>{{{$answer['data']->username}}} </b> on {{$answer['data']->createdAt}}
                </div>
            </div>
        </div>
        @endforeach
      </div>
    </div>
      </div>

      </div>
    </div>
    @stop
