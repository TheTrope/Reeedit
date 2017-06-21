


<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ url('css/materialize.css')}}" rel="stylesheet" type="text/css">
        <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
        <script src="{{ url('js/materialize.js')}}" type="text/javascript"></script>
        <style>
        body {
          display: flex;
          min-height: 100vh;
          flex-direction: column;
        }

        main {
          flex: 1 0 auto;
        }
        </style>
    </head>
    <body>
<header>

      <nav class="nav-extended">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">Threaddy</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
          </ul>
        </div>
        <div class="nav-content">
          <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#test1">Test 1</a></li>
            <li class="tab"><a class="active" href="#test2">Test 2</a></li>
            <li class="tab disabled"><a href="#test3">Disabled Tab</a></li>
            <li class="tab"><a href="#test4">Test 4</a></li>
          </ul>
        </div>
      </nav>
      <div class="row">
        <div class="card-panel col s6">
            Bonjour
        </div>
        <div class="col s1">

        </div>
</header>
        <div class="card-panel col s5 " >
          <form class="">
            Log In
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix">First Name</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_telephone" type="tel" class="validate">
                <label for="icon_telephone">Telephone</label>
              </div>
            </div>
          </form>
        </div>
      </div>

      <footer class="page-footer">
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
