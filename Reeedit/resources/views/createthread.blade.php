
@extends("default")
@section("title1", "Subs")
@section("titlelinkl", "/subs")
@section("title2", "Create Thread")
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
      @if (isset($subid))


    <div class="card col s12 " >

      <form class="" action="/createthread/{{$subid}}" method="post">
        {!! csrf_field() !!}
        <div class="row">
          <div class="input-field col s7">
            <i class="material-icons prefix">label</i>
              <input id="thread" name="threadname" type="text" class="validate">
              <label for="thread" data-error="!" data-success="ok">Thread Name</label>
          </div>
          <div class="input-field col s7">
            <i class="material-icons prefix">mode_edit</i>
            <textarea name="description" id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Your question</label>
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
