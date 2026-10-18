<x-mainpage>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="mb-3">Film szerkesztése</h1>
      <form method="post" action="{{ route('film.update', $film) }}" novalidate>
        @csrf
        @method('PUT')
        @include('film._form')
        <button type="submit" class="btn btn-primary">Módosítás mentése</button>
        <a href="{{ route('film.index') }}" class="btn btn-outline-secondary">Mégse</a>
      </form>
    </div>
  </div>
</x-mainpage>