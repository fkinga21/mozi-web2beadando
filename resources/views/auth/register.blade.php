<x-mainpage>
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h3 mb-3">Regisztráció</h1>

          <form method="post" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Név</label>
              <input type="text" id="name" name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}" autofocus>
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">E-mail cím</label>
              <input type="email" id="email" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}">
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Jelszó</label>
              <input type="password" id="password" name="password"
                     class="form-control @error('password') is-invalid @enderror">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Regisztráció</button>
            </div>
          </form>

          <p class="text-center mt-3 mb-0">
            Van már fiókod? <a href="{{ route('login') }}">Bejelentkezés</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</x-mainpage>