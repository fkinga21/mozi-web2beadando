<x-mainpage>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="mb-3">Új film</h1>
      <form method="post" action="{{ route('film.store') }}" novalidate>
        @csrf
        @include('film._form')
        <button type="submit" class="btn btn-primary">Mentés</button>
        <a href="{{ route('film.index') }}" class="btn btn-outline-secondary">Mégse</a>
      </form>
    </div>
  </div>
</x-mainpage>