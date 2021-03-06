<nav class="navbar fixed-top navbar-expand-md navbar-light bg-info shadow-sm">
      <a class="navbar-brand text-light" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-5">
                   <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Posts
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="{{url('blog-posts')}}">View All</a>
                       @Auth
                       @if(Auth::user()->role->name != 'admin')
                       <a class="dropdown-item" href="{{route('blog-posts.create')}}">Create</a>
                       @endif
                       @endAuth
                     </div>
                   </li>
                   <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Authors
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="{{url('authors')}}">View All</a>
                       @if(Auth::user())
                       <a class="dropdown-item" href="">Vote</a>
                       @endif
                     </div>
                   </li>
               </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

              @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
</nav>
