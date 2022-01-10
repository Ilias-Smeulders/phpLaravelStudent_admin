<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Student administration</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/courses">courses</a>
                </li>
                @auth
                    @if(auth()->user()->admin)
                        <li class="nav-item">
                            <a href="/programmes" class="nav-link">Programmes</a>
                        </li>
                    @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login" style="margin-left:40vw"><i class="fas fa-sign-in-alt"></i>Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown" style="margin-left: 40vw">
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Logout</button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
