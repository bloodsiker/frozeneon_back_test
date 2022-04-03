<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <li class="nav-item">
            @auth
                <a href="{{ route('logout') }}" class="btn btn-primary my-2 my-sm-0"
                   data-target="#loginModal">Log out, {{ auth()->user()->personaname }}
                </a>
            @else
                <button type="button" class="btn btn-success my-2 my-sm-0" type="submit" data-toggle="modal"
                        data-target="#loginModal">Log IN
                </button>
            @endauth
        </li>
        <li class="nav-item">
            @auth
                <button type="button" class="btn btn-success my-2 my-sm-0" type="submit" data-toggle="modal"
                        data-target="#addModal">Add balance
                </button>
            @endauth
        </li>
        <li class="nav-item">
            @auth
                <a href="" role="button">
                    Likes: {{ auth()->user()->likes_balance }}
                </a>
            @endauth
        </li>
    </div>
</nav>
