<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">Mozi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Menü">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Főoldal</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('adatbazis') ? 'active' : '' }}" href="/adatbazis">Adatbázis</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('kapcsolat') ? 'active' : '' }}" href="/kapcsolat">Kapcsolat</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('diagram') ? 'active' : '' }}" href="/diagram">Diagram</a></li>

        @auth
          <li class="nav-item"><a class="nav-link {{ request()->is('uzenetek') ? 'active' : '' }}" href="/uzenetek">Üzenetek</a></li>
          @if (Auth::user()->role == 1)
            <li class="nav-item"><a class="nav-link {{ request()->is('film*') ? 'active' : '' }}" href="/film">CRUD</a></li>
          @endif
        @endauth
      </ul>

      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="/login">Bejelentkezés</a></li>
          <li class="nav-item"><a class="nav-link" href="/register">Regisztráció</a></li>
        @endguest
        @auth
          <li class="nav-item">
            <form method="post" action="/logout" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm ms-lg-2">Kijelentkezés</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>