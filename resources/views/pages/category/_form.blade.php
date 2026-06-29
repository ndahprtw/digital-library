<div class="mb-3">
    <label class="form-label" for="nama_kategori"> Nama Kategori </label>
    <input class="form-control @error('nama_kategori') is-invalid @enderror" type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $buku?->nama_kategori ?? '') }}">
    @error('nama_kategori') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>