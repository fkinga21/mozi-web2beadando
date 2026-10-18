<x-mainpage>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="mb-1">Kapcsolat</h1>
      <p class="text-muted">Írj nekünk, és az üzeneted eljut a Művészfilm Kht.-hoz.</p>

      @if (session('siker'))
        <div class="alert alert-success">{{ session('siker') }}</div>
      @endif

      <form method="post" action="/kapcsolat" novalidate>
        @csrf

        <div class="mb-3">
          <label for="nev" class="form-label">Név</label>
          <input type="text" id="nev" name="nev"
                 class="form-control @error('nev') is-invalid @enderror"
                 value="{{ old('nev', auth()->user()->name ?? '') }}">
          @error('nev') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail cím</label>
          <input type="email" id="email" name="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email', auth()->user()->email ?? '') }}">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="uzenet" class="form-label">Üzenet</label>
          <textarea id="uzenet" name="uzenet" rows="6"
                    class="form-control @error('uzenet') is-invalid @enderror">{{ old('uzenet') }}</textarea>
          @error('uzenet') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Üzenet küldése</button>
      </form>
    </div>
  </div>
</x-mainpage>