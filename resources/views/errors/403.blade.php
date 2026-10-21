<x-mainpage>
  <div class="text-center py-5">
    <h1 class="display-3 fw-bold text-danger">403</h1>
    <p class="lead">{{ $exception->getMessage() ?: 'Ehhez az oldalhoz nincs jogosultságod.' }}</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Vissza a Főoldalra</a>
  </div>
</x-mainpage>