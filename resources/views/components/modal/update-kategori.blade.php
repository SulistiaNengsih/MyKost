<!-- Edit Kategori -->
<div class="modal fade" id="editKategori" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editKategoriLabel">Edit Kategori</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url('/update-kategori')}}" method="post">
              @csrf
              <div class="col-12">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" value="" required>
                <div class="invalid-feedback">
                  Tolong masukkan nama kategori.
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <input type="hidden" id="jenisUpdate" name="jenisUpdate" value="{{$jenis}}">
          <input type="hidden" id="idUpdate" name="idUpdate" class="idUpdate" value="">
          <button type="submit" class="btn btn-primary">Edit Kategori</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>