<div class="mb-3">
  <label for="cim" class="form-label">Cím</label>
  <input type="text" id="cim" name="cim"
         class="form-control @error('cim') is-invalid @enderror"
         value="{{ old('cim', $film->cim ?? '') }}">
  @error('cim') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="ev" class="form-label">Bemutató éve</label>
    <input type="number" id="ev" name="ev"
           class="form-control @error('ev') is-invalid @enderror"
           value="{{ old('ev', $film->ev ?? '') }}">
    @error('ev') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="hossz" class="form-label">Hossz (perc)</label>
    <input type="number" id="hossz" name="hossz"
           class="form-control @error('hossz') is-invalid @enderror"
           value="{{ old('hossz', $film->hossz ?? '') }}">
    @error('hossz') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>