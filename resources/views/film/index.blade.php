<x-mainpage>
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <div>
      <h1 class="mb-0">CRUD – Filmek kezelése</h1>
      <p class="text-muted mb-0">Csak admin számára: filmek létrehozása, listázása, módosítása és törlése.</p>
    </div>
    <a href="{{ route('film.create') }}" class="btn btn-primary">+ Új film</a>
  </div>

  @if (session('siker'))
    <div class="alert alert-success">{{ session('siker') }}</div>
  @endif
  @if (session('hiba'))
    <div class="alert alert-danger">{{ session('hiba') }}</div>
  @endif

  <form method="get" action="{{ route('film.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
      <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Keresés a címben...">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-outline-primary">Keresés</button>
      <a href="{{ route('film.index') }}" class="btn btn-outline-secondary">Törlés</a>
    </div>
  </form>

  <p class="small text-muted">Találatok száma: {{ $filmek->total() }}</p>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Cím</th>
          <th class="text-end">Év</th>
          <th class="text-end">Hossz (perc)</th>
          <th class="text-end">Előadások</th>
          <th class="text-end">Műveletek</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($filmek as $f)
          <tr>
            <td>{{ $f->id }}</td>
            <td>{{ $f->cim }}</td>
            <td class="text-end">{{ $f->ev }}</td>
            <td class="text-end">{{ $f->hossz }}</td>
            <td class="text-end">{{ $f->eloadasok_count }}</td>
            <td class="text-end text-nowrap">
              <a href="{{ route('film.edit', $f) }}" class="btn btn-sm btn-outline-primary">Szerkesztés</a>
              <form method="post" action="{{ route('film.destroy', $f) }}" class="d-inline"
                    onsubmit="return confirm('Biztosan törlöd ezt a filmet?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Törlés</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted">Nincs találat.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center">
    {{ $filmek->links() }}
  </div>
</x-mainpage>