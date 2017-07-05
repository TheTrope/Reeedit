


<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Threaddy</title>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link href="{{ url('css/materialize.css')}}" rel="stylesheet" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="{{ url('js/materialize.js')}}" type="text/javascript"></script>
  <style>
  .page-flexbox-wrapper {
    display: flex;
    min-height: 75vh;
    flex-direction: column;
  }

  main {
    padding: 0;
    min-height: 80vh;
  }
  .mainbody{
    margin-right: 10px;
  }
  .mainbody > .col{
    padding: 0;
  }
  .menu{
    height:  100%;
    position: fixed;
  }
  .mylogo{
    color: #009688 !important;
    padding-top: 20px;
  }
  .errorbadge{
    color: white;
    border-top: 1px solid white;
    padding: 5px;

  }
  .card .card-content{
    padding: 15px;
  }
  </style>
</head>
<body>
  <ul class=" side-nav  fixed col s2 ">
    <li class="logo center-align">
      <i class="mylogo large material-icons">question_answer</i>
    </li>
    <li class="bold">
      <a href="/welcome">Index</a>
      <a href="/signin">Sign In</a>
      <a href="/subs">Subs</a>
      <a href="/signin">Top Threads</a>

    </li>

  </ul>
  <div class="mainbody row">

    <div class="page-flexbox-wrapper col offset-s2 s10">

      <main>
        <nav>
          <div class="nav-wrapper">
            <a href="#!" class="brand-logo center">Threaddy</a>
            <!--
            <ul class="left hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li class="active"><a href="collapsible.html">JavaScript</a></li>
          </ul>
        -->
      </div>
    </nav>
    @if (isset($carderror))
    <div class="row">
      <div class="badge errorbadge red lighten-2">
        @if($carderror)
        Wrong identifiers
        @else
        You are logged in
        @endif
      </div>
    </div>
    @endif

    @foreach ($errors->all() as $error)
    <!--<div>{{ $error }}</div>-->
    @endforeach


    <div class="row">

      <nav class="card-panel teal lighten-2  col s7">
        <div class="nav-wrapper">
          <div class="col s12">
            @if(View::hasSection('title1'))
              <a href="@yield('titlelink1', '#')" class="breadcrumb">@yield('title1')</a>
              @if(View::hasSection('title2'))
                <a href="#!" class="breadcrumb">@yield('title2')</a>
                @if(View::hasSection('title3'))
                  <a href="#!" class="breadcrumb">@yield('title3')</a>
                @endif
              @endif
            @else
            <a href="#!" class="breadcrumb">Unknown</a>
            @endif
            <!--
            <a href="#!" class="breadcrumb">Second</a>
            <a href="#!" class="breadcrumb">Third</a>
          -->
        </div>
      </div>
    </nav>
    <div class="col s1"></div>


    @if(Session::has('user'))

    <div class="card col s4 teal lighten-2" >
      <div class="card-content">
        <div class="nav-wrapper">
          <span class=" col breadcrumb">
          Connected as <b>{{ Session::get('user')->username }}</b>
          </span>
        </div>
      </div>
    </div>
    @else
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
    @endif
  </div>
@yield('content')
</main>
<footer class="col s12 page-footer">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Threaddy</h5>
        <p class="grey-text text-lighten-4">Php project</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Authors</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="#!">bosma_f</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">eutrop_a</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">perard_a</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">perron_g</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      © 2017 Copyright
    </div>
  </div>
</footer>
</div>
</div>

</body>
</html>
<!--
<div class="flex-center position-ref full-height">
@if (Route::has('login'))
<div class="top-right links">
@if (Auth::check())
<a href="{{ url('/home') }}">Home</a>
@else
<a href="{{ url('/login') }}">Login</a>
<a href="{{ url('/register') }}">Register</a>
@endif
</div>
@endif

<div class="content">
<div class="title m-b-md">
Laravell
</div>

<div class="links">
<a href="{{ url('/test') }}">Documentation</a>
<a href="https://laracasts.com">Laracasts</a>
<a href="https://laravel-news.com">News</a>
<a href="https://forge.laravel.com">Forge</a>
<a href="https://github.com/laravel/laravel">GitHub</a>
</div>
</div>
</div>

-->
