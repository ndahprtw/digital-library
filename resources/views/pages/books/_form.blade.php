<div class="mb-3">
    <label class="form-label" for="judul"> Judul </label>
    <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" id="judul" value="{{ old('judul', $buku?->judul ?? '') }}">
    @error('judul') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="penulis"> Penulis </label>
    <input class="form-control @error('penulis') is-invalid @enderror" type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku?->penulis ?? '') }}">
    @error('penulis') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="penerbit"> Penerbit </label>
    <input class="form-control @error('penerbit') is-invalid @enderror" type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku?->penerbit ?? '') }}">
    @error('penerbit') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="tahun_terbit"> Tahun Terbit </label>
    <input class="form-control @error('tahun_terbit') is-invalid @enderror" type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $buku?->tahun_terbit ?? '') }}">
    @error('tahun_terbit') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="stok"> Stok </label>
    <input class="form-control @error('stok') is-invalid @enderror" type="number" name="stok" id="stok" value="{{ old('stok', $buku?->stok ?? '') }}">
    @error('stok') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="cover"> Cover </label>
    <input class="form-control @error('cover') is-invalid @enderror" type="file" name="cover" id="cover" value="{{ old('cover', $buku?->cover ?? '') }}">
    @error('cover') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>