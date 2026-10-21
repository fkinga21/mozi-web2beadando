<x-mainpage>
  <div class="p-5 mb-4 bg-primary text-white rounded-3 shadow">
    <h1 class="display-4 fw-bold">Művészfilm Kht.</h1>
    <p class="lead col-lg-8 px-0">
      Több városban üzemeltetünk mozikat, és minden előadás nézőszámát és bevételét pontosan nyilvántartjuk.
      Böngészd az 1999-es adatokat, nézd meg a diagramokat, vagy küldj üzenetet nekünk.
    </p>
    <a class="btn btn-light btn-lg me-2" href="{{ route('adatbazis') }}">Adatbázis</a>
    <a class="btn btn-outline-light btn-lg" href="{{ route('diagram') }}">Diagram</a>
  </div>

  <div class="row g-3 text-center">
    <div class="col-6 col-lg-3">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="display-6 fw-bold text-primary">{{ $mozik }}</div>
        <div class="text-muted">mozi</div>
      </div></div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="display-6 fw-bold text-primary">{{ $filmek }}</div>
        <div class="text-muted">film</div>
      </div></div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="display-6 fw-bold text-primary">{{ number_format($eloadasok, 0, ',', ' ') }}</div>
        <div class="text-muted">előadás</div>
      </div></div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="display-6 fw-bold text-primary">{{ number_format($nezok, 0, ',', ' ') }}</div>
        <div class="text-muted">néző összesen</div>
      </div></div>
    </div>
  </div>

  <div class="row mt-4 g-3">
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
      <h5 class="card-title">Adatbázis</h5>
      <p class="card-text">Az előadások a filmek és mozik adataival együtt, lapozható listában.</p>
    </div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
      <h5 class="card-title">Diagram</h5>
      <p class="card-text">A bevételek alakulása havi bontásban, látványos grafikonon.</p>
    </div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
      <h5 class="card-title">Kapcsolat</h5>
      <p class="card-text">Kérdésed van? Írj nekünk az űrlapon keresztül.</p>
    </div></div></div>
  </div>
</x-mainpage>