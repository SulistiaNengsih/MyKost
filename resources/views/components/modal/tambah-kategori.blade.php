<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/add-kategori" method="post">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahKategoriLabel">Tambah Kategori</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <label for="jenis" class="form-label">Jenis Kategori</label>
              <select class="form-select" id="jenis" name="jenis" required>
                <option value="">Pilih jenis kategori...</option>
                <option>Pengeluaran</option>
                <option>Pemasukan</option>
              </select>
              <div class="invalid-feedback">
                Tolong pilih jenis kategori.
              </div>
            </div>
            <div class="col-12">
              <label for="namaKategori" class="form-label">Nama Kategori</label>
              <input type="text" class="form-control" id="namaKategori" name="namaKategori" placeholder="Nama kategori..." required>
              <div class="invalid-feedback">
                Tolong masukkan nama kategori.
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
          </div>     
        </form>
      </div>
    </div>
  </div>