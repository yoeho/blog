<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Bangers|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
  </head>
  <body>


    <nav class="shelf">
      @if (Route::has('login'))

        <a class="book about-us">Contant</a>
        @auth
          <a href="{{ url('/home') }}" class="btn book home-page">Home page</a>
        @else
          <a href="{{ route('login') }}" class="btn book faq">login</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="btn book contact">Register</a>
        @endif
        @endauth
      @endif

      <span class="book not-found"></span>

      <span class="door left"></span>
      <span class="door right"></span>
    </nav>
    <h1 class="display-4 my-5">'Welcome To My Blog'</h1>


        <!-- <nav class="navbar navbar-toggleable-md fixed-top navbar-transparent" color-on-scroll="500">
            <div class="container">
                <div class="navbar-translate">
                    <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                    </button>
                    <a class="navbar-brand" href="https://www.example.com">BLOG</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarToggler">
                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/" target="_blank">
                                <i class="fa fa-twitter"></i>
                                <p class="hidden-lg-up">Twitter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/" target="_blank">
                                <i class="fa fa-facebook-square"></i>
                                <p class="hidden-lg-up">Facebook</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/" target="_blank">
                                <i class="fa fa-instagram"></i>
                                <p class="hidden-lg-up">Instagram</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Star on GitHub" data-placement="bottom" href="https://www.github.com/" target="_blank">
                                <i class="fa fa-github"></i>
                                <p class="hidden-lg-up">GitHub</p>
                            </a>
                        </li>
                                @auth
                                <li class="nav-item">
            						<a href="{{ url('/home') }}" class="btn btn-danger btn-round">Home</a>
            					</li>
                                @else
                                <li class="nav-item">
            						<a href="{{ route('login') }}" class="btn btn-danger btn-round">Login</a>
            					</li>

                                  @if (Route::has('register'))
                                  <li class="nav-item">
                          <a href="{{ route('register') }}" class="btn btn-danger btn-round">Register</a>
                        </li>
                                    @endif
                                @endauth
                  </ul>
                        @endif
                </div>
            </div>
        </nav> -->
        <!-- <div class="wrapper">
            <div class="page-header section-dark" style="background-image: url('http://demos.creative-tim.com/paper-kit-2/assets/img/antoine-barres.jpg')">
                <div class="filter"></div>
        		<div class="content-center">
        			<div class="container">
        				<div class="title-brand">
        					<h1 class="presentation-title">MY BLOG</h1>
        					<div class="fog-low">
        						<img src="http://demos.creative-tim.com/paper-kit-2/assets/img/fog-low.png" alt="">
        					</div>
        					<div class="fog-low right">
        						<img src="http://demos.creative-tim.com/paper-kit-2/assets/img/fog-low.png" alt="">
        					</div>
        				</div>

        				<h2 class="presentation-subtitle text-center">Headline</h2>
        			</div>
        		</div>
                <div class="moving-clouds" style="background-image: url('http://demos.creative-tim.com/paper-kit-2/assets/img/clouds.png'); ">

                </div>
        	</div>
      </div> -->
  </body>
</html>
