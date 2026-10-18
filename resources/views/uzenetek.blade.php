<x-mainpage>
  <h1 class="mb-1">Üzenetek</h1>
  <p class="text-muted">A Kapcsolat űrlapon beküldött üzenetek, a legfrissebb elöl.</p>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>Küldés ideje</th>
          <th>Név</th>
          <th>E-mail</th>
          <th>Üzenet</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($uzenetek as $u)
          <tr>
            <td class="text-nowrap">{{ $u->created_at->format('Y.m.d. H:i') }}</td>
            <td>{{ $u->nev }}</td>
            <td>{{ $u->email }}</td>
            <td>{!! nl2br(e($u->uzenet)) !!}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">Még nincs beküldött üzenet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center">
    {{ $uzenetek->links() }}
  </div>
</x-mainpage>