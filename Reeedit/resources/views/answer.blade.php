
@extends("default")
@section('title1', 'Answer')
@section('content')



  <div class="card-panel">
    <div class="row">
      @if(isset($result))
      <div class="col s12">
        {{$result}}
      </div>
      @endif
    </div>
    <div class="row">

      @if (isset($tid) && isset($aid) && isset($prevAns))
      <p>

      <i>
        <i class="material-icons prefix tiny">textsms</i> &nbsp;&nbsp;
        {{{$prevAns->content}}} - <b>By {{ $prevAns->username}}</b></i>
      </p>


    <div class="card col s12 " >

      <form class="" action="/answer/{{$tid}}/{{$aid}}" method="post">
        {!! csrf_field() !!}
        <div class="row">
          <div class="input-field col s7">
            <i class="material-icons prefix">mode_edit</i>
            <textarea name="content" id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Your answer</label>
          </div>
          <div class="col s1"></div>
          <div class="input-field col s3">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>

          </div>

        </div>
      </form>
    </div>
    @else
      <script>
        window.location.href = '/welcome';
      </script>
    @endif
  </div>
</div>
@stop
