
@extends("default")
@section('title1', 'Sign In')
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


    <div class="card col s12 " >
      <form class="" action="/signin" method="post">
        {!! csrf_field() !!}
        <div class="row">
          <div class="input-field col s7">
            <i class="material-icons prefix">account_circle</i>

            @if($errors->has('username'))
              <input id="username" name="username" type="text" class="validate invalid">
              <label for="username" data-error="!" data-success="ok">Username</label>
            @else
              <input id="username" name="username" type="text" class="validate">
              <label for="username" data-error="!" data-success="ok">Username</label>
            @endif
          </div>
          <div class="input-field col s7">
            <i class="material-icons prefix">email</i>
            @if($errors->has('email'))
              <input id="email" name="email" type="email" class="validate invalid">
              <label for="email" data-error='!' data-success="ok">Email</label>
            @else
              <input id="email" name="email" type="email" class="validate">
              <label for="email" data-error="!" data-success="ok">Email</label>
            @endif
          </div>
          <div class="input-field col s7">
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
@stop
