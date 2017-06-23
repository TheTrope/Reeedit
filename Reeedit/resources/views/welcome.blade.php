
@extends("default")

@section('content')

{{var_dump($errors)}}

   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach


  <div class="card-panel">
    <div class="row">

      <nav class="card-panel teal lighten-2  col s7">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="#!" class="breadcrumb">Welcome</a>
            <!--
            <a href="#!" class="breadcrumb">Second</a>
            <a href="#!" class="breadcrumb">Third</a>
          -->
          </div>
        </div>
      </nav>
    <div class="col s1"></div>

    <div class="card col s4 " >
      <form class="" action="/login" method="post">
        {!! csrf_field() !!}
        <div class="row">
          <div class="input-field col s4">
            <i class="material-icons prefix">account_circle</i>

            @if($errors->has('username'))
              <input id="username" name="username" type="text" class="validate invalid">
              <label for="username" data-error="!" data-success="ok">Username</label>
            @else
              <input id="username" name="username" type="text" class="validate">
              <label for="username" data-error="!" data-success="ok">Username</label>
            @endif
          </div>
          <div class="input-field col s4">
            <i class="material-icons prefix">vpn_key</i>
            @if($errors->has('password'))
              <input id="password" name="password" type="password" class="validate invalid">
              <label for="password" data-error='!' data-success="ok">Password</label>
            @else
              <input id="password" name="password" type="password" class="validate">
              <label for="password" data-error="!" data-success="ok">Password</label>
            @endif
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
  </div>
</div>
</div>
@stop
