<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- <img class="navbar-brand" src="/storage/logo/Watchlist3.png" width="20%"> -->
       <a class="navbar-brand" href="{{ url('/') }}" style="font-size:32px;">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item p-2">
                    <a class="nav-link"  style="color:black;" href="/">Home <span class="sr-only"></span></a>
                </li>

                <li class="nav-item dropdown p-2">
                    <a id="navbarDropdown"  style="color:black;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Anime <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/most-watched-anime" >
                            Most Watched
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/top-rated-anime">
                            Top Rated
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/currently-airing-anime">
                            Currently Airing
                            </a>
                    </div>
                </li>

                <li class="nav-item dropdown p-2">
                    <a id="navbarDropdown"  style="color:black;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        TV Show <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/most-watched-tv" >
                            Most Watched
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/top-rated-tv">
                            Top Rated
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/currently-airing-tv">
                            Currently Airing
                            </a>
                    </div>
                </li>

                <li class="nav-item dropdown p-2">
                    <a id="navbarDropdown"  style="color:black;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Hollywood <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/most-watched-hollywood" >
                            Most Watched
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/top-rated-hollywood">
                            Top Rated
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown p-2">
                    <a id="navbarDropdown"  style="color:black;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Bollywood <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/most-watched-bollywood" >
                            Most Watched
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/top-rated-bollywood">
                            Top Rated
                        </a>
                    </div>
                 </li>
                
                <li class="nav-item p-2">
                    <a class="nav-link" style="color:black;" href="/blog">Blog<span class="sr-only"></a>
                </li>
                <li class="nav-item p-2">
                        <a class="nav-link" style="color:black;" href="/users">Users<span class="sr-only"></a>
                    </li>
                <li class="nav-item p-2">
                        <a class="nav-link" style="color:black;" href="/about">About<span class="sr-only"></a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a class="dropdown-item" href="/dashboard">
                                 Dashboard
                            </a>
                            <a class="dropdown-item" href="/profile">
                                Profile
                            </a>

                            <a class="dropdown-item" href="/update-details">
                                Update Details
                            </a>
                            @if(Auth::user()->id == 1)
                                <a class="dropdown-item" href="/admin-panel">
                                    Admin Panel
                                </a>
                            @endif

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
    </div>
</nav>