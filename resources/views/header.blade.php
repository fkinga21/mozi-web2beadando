<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Mozi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Menü">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Főoldal</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('adatbazis') ? 'active' : '' }}" href="{{ route('adatbazis') }}">Adatbázis</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('kapcsolat') ? 'active' : '' }}" href="{{ route('kapcsolat') }}">Kapcsolat</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('diagram') ? 'active' : '' }}" href="{{ route('diagram') }}">Diagram</a></li>

        @auth
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('uzenetek') ? 'active' : '' }}" href="{{ route('uzenetek') }}">Üzenetek</a></li>
          @if (Auth::user()->role == 1)
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('film.*') ? 'active' : '' }}" href="{{ route('film.index') }}">CRUD</a></li>
          @endif
        @endauth
      </ul>

      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Regisztráció</a></li>
        @endguest
        @auth
          <li class="nav-item">
            <form method="post" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm ms-lg-2">Kijelentkezés</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>