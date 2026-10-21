<x-mainpage>
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h3 mb-3">Bejelentkezés</h1>

          <form method="post" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">E-mail cím</label>
              <input type="email" id="email" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" autofocus>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Jelszó</label>
              <input type="password" id="password" name="password"
                     class="form-control @error('password') is-invalid @enderror">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
              <label class="form-check-label" for="remember">Emlékezz rám</label>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </div>
          </form>

          <p class="text-center mt-3 mb-0">
            Még nincs fiókod? <a href="{{ route('register') }}">Regisztráció</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</x-mainpage>