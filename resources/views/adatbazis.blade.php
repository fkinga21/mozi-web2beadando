<x-mainpage>
  <h1 class="mb-1">Adatbázis</h1>
  <p class="text-muted">A Művészfilm Kht. mozijainak, filmjeinek és 1999-es előadásainak adatai.</p>

  <ul class="nav nav-tabs mb-3" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-eloadas" type="button" role="tab">Előadások</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-mozi" type="button" role="tab">Mozik</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-film" type="button" role="tab">Filmek</button>
    </li>
  </ul>

  <div class="tab-content">

    {{-- ELŐADÁSOK --}}
    <div class="tab-pane fade show active" id="tab-eloadas" role="tabpanel">
      <form method="get" action="{{ route('adatbazis') }}" class="row g-2 mb-3">
        <div class="col-md-5">
          <select name="mozi" class="form-select">
            <option value="">Minden mozi</option>
            @foreach ($mozik as $m)
              <option value="{{ $m->id }}" @selected(request('mozi') == $m->id)>{{ $m->nev }} ({{ $m->varos }})</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <select name="film" class="form-select">
            <option value="">Minden film</option>
            @foreach ($filmek as $f)
              <option value="{{ $f->id }}" @selected(request('film') == $f->id)>{{ $f->cim }} ({{ $f->ev }})</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" class="btn btn-primary">Szűrés</button>
        </div>
        <div class="col-md-1 d-grid">
          <a href="{{ route('adatbazis') }}" class="btn btn-outline-secondary">Törlés</a>
        </div>
      </form>

      <p class="small text-muted">Találatok száma: {{ number_format($eloadasok->total(), 0, ',', ' ') }}</p>

      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Dátum</th>
              <th>Film</th>
              <th>Mozi</th>
              <th>Város</th>
              <th class="text-end">Nézők</th>
              <th class="text-end">Bevétel</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($eloadasok as $e)
              <tr>
                <td>{{ $e->datum->format('Y.m.d.') }}</td>
                <td>{{ $e->film->cim }}</td>
                <td>{{ $e->mozi->nev }}</td>
                <td>{{ $e->mozi->varos }}</td>
                <td class="text-end">{{ number_format($e->nezoszam, 0, ',', ' ') }}</td>
                <td class="text-end">{{ number_format($e->bevetel, 0, ',', ' ') }}</td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-muted">Nincs találat.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-center">
        {{ $eloadasok->links() }}
      </div>
    </div>

    {{-- MOZIK --}}
    <div class="tab-pane fade" id="tab-mozi" role="tabpanel">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Név</th>
              <th>Város</th>
              <th class="text-end">Férőhely</th>
              <th class="text-end">Nézők összesen</th>
              <th class="text-end">Bevétel összesen</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mozik as $m)
              <tr>
                <td>{{ $m->nev }}</td>
                <td>{{ $m->varos }}</td>
                <td class="text-end">{{ $m->ferohely }}</td>
                <td class="text-end">{{ number_format($m->eloadasok_sum_nezoszam, 0, ',', ' ') }}</td>
                <td class="text-end">{{ number_format($m->eloadasok_sum_bevetel, 0, ',', ' ') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- FILMEK --}}
    <div class="tab-pane fade" id="tab-film" role="tabpanel">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Cím</th>
              <th class="text-end">Év</th>
              <th class="text-end">Hossz (perc)</th>
              <th class="text-end">Előadások száma</th>
              <th class="text-end">Bevétel összesen</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($filmek as $f)
              <tr>
                <td>{{ $f->cim }}</td>
                <td class="text-end">{{ $f->ev }}</td>
                <td class="text-end">{{ $f->hossz }}</td>
                <td class="text-end">{{ number_format($f->eloadasok_count, 0, ',', ' ') }}</td>
                <td class="text-end">{{ number_format($f->eloadasok_sum_bevetel, 0, ',', ' ') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</x-mainpage>